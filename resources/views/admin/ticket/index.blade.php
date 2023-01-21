@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Ticket List</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Ticket List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-4">
                                        <label for="service">Ticket Type</label>
                                        <select name="service" class="form-control submitable" id="service">
                                            <option value="{{ null }}" selected>All</option>
                                            <option value="Technical">Technical</option>
                                            <option value="Payment">Payment</option>
                                            <option value="Affliate">Affliate</option>
                                            <option value="Return">Return</option>
                                            <option value="Refund">Refund</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="status">Status</label>
                                        <select name="status" class="form-control submitable" id="status">
                                            <option value="{{ null }}" selected>All</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Replied</option>
                                            <option value="2">Close</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-4">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" id="date" class="form-control submitable">
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>User</th>
                                            <th>Subject</th>
                                            <th>Service</th>
                                            <th>Priority</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <form id="delete_product" action="" method="delete">
                                @csrf
                                @method('DELETE')
                            </form>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    <!-- script -->
    @push('script')
        <script type="text/javascript">
            var table;
            $(function() {
                table = $(".ytable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('ticket.list') }}",
                        data: function(e) {
                            e.service = $("#service").val();
                            e.status = $("#status").val();
                            e.date = $("#date").val();
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "name",
                            name: "name",
                        },
                        {
                            data: "subject",
                            name: "subject",
                        },
                        {
                            data: "service",
                            name: "service",
                        },
                        {
                            data: "priority",
                            name: "priority",
                        },
                        {
                            data: "date",
                            name: "date",
                        },
                        {
                            data: "status",
                            name: "status",
                        },
                        {
                            data: "action",
                            name: "action",
                            orderable: true,
                            searchable: true
                        },
                    ]
                });

                //filtering
                $('.submitable').change(function() {
                    $('.ytable').DataTable().ajax.reload();
                });
            })
        </script>
        <script>
            function deleteProductById(id) {
                let url = "{{ route('product.delete', ':id') }}";
                url = url.replace(':id', id);

                swal({
                        title: "Are you Want to delete?......",
                        text: "Once Delete, This will be Permanently Delete!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                type: "DELETE",
                                async: false,
                                url: url,
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    toastr.success(data);
                                    table.ajax.reload();
                                    $("#delete_product")[0].reset();
                                }
                            })
                        } else {
                            swal("Safe Data!");
                        }
                    });
            }
        </script>
    @endpush
@endsection

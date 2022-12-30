@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Coupon</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#couponModal">
                                Add New
                            </button>
                        </ol>
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
                                <h3 class="card-title">All Coupon List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Coupon Code</th>
                                            <th>Coupon Valid Date</th>
                                            <th>Coupon Type</th>
                                            <th>Coupon Amount</th>
                                            <th>Coupon Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <form id="delete_coupon" action="" method="delete">
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

    {{-- coupon add model --}}
    <div class="modal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warehouseModal">Add New Coupon</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('coupon.store') }}" method="POST" id="add_coupon_form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="coupon_code">Coupon Code</label>
                            <input type="text" class="form-control" name="coupon_code" value="{{ old('coupon_code') }}"
                                placeholder="Coupon Code" required>
                        </div>
                        <div class="form-group">
                            <label for="coupon_type">Coupon Type</label>
                            <select name="coupon_type" class="form-control">
                                <option value="1">Fixed</option>
                                <option value="2">Percentage</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="coupon_amount">Coupon Amount</label>
                            <input type="number" min="0"class="form-control" name="coupon_amount"
                                value="{{ old('coupon_amount') }}" placeholder="Coupon Amount" required>
                        </div>
                        <div class="form-group">
                            <label for="coupon_valid_date">Coupon Valid Date</label>
                            <input type="date" class="form-control" name="coupon_valid_date"
                                value="{{ old('coupon_valid_date') }}" placeholder="Coupon Valid Date" required>
                        </div>
                        <div class="form-group">
                            <label for="coupon_status">Coupon Status</label>
                            <select name="coupon_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- coupon edit model --}}
    <div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="editCouponModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCouponModal">Edit Warehouse</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div id="modal_body"></div>
            </div>
        </div>
    </div>

    <!-- script -->
    @push('script')
        <script type="text/javascript">
            var table;
            $(function() {
                table = $(".ytable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('coupon.list') }}",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "coupon_code",
                            name: "coupon_code"
                        },
                        {
                            data: "coupon_valid_date",
                            name: "coupon_valid_date"
                        },
                        {
                            data: "coupon_type",
                            name: "coupon_type"
                        },
                        {
                            data: "coupon_amount",
                            name: "coupon_amount"
                        },
                        {
                            data: "coupon_status",
                            name: "coupon_status"
                        },
                        {
                            data: "action",
                            name: "action",
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            });

            $("#add_coupon_form").submit(function(e) {
                e.preventDefault();
                let url = $(this).attr('action');
                let request = $(this).serialize();

                $("button[type=submit]").attr('disabled', true);

                $.ajax({
                    type: "POST",
                    url: url,
                    async: false,
                    data: request,
                    success: function(data) {
                        toastr.success(data);
                        $("#add_coupon_form")[0].reset();
                        $("#couponModal").modal("hide");
                        $("button[type=submit]").attr('disabled', false);
                        table.ajax.reload();
                    },
                    error: function(error) {
                        $("button[type=submit]").attr('disabled', false);
                    }
                });
            });

            function getCouponById(id) {
                let url = "{{ route('coupon.edit', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#modal_body").html(data);
                    }
                });
            }

            function deleteCouponById(id) {
                let url = "{{ route('coupon.delete', ':id') }}";
                url = url.replace(':id', id);

                var request = $("#delete_coupon").serialize();

                swal({
                        title: "Are you Want to delete?",
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
                                data: request,
                                success: function(data) {
                                    toastr.success(data);
                                    table.ajax.reload();
                                    $("#delete_coupon")[0].reset();
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

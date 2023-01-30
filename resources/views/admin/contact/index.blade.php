@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contact</h1>
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
                                <h3 class="card-title">All Contact List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Message</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
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

    {{-- brand edit model --}}
    <div class="modal fade" id="editContactModal" tabindex="-1" aria-labelledby="editContactModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">View Contact Message</h5>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
        <script type="text/javascript">
            var table;
            $(function() {
                table = $(".ytable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('contact.list') }}",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "name",
                            name: "name",
                        },
                        {
                            data: "email",
                            name: "email"
                        },
                        {
                            data: "phone",
                            name: "phone"
                        },
                        {
                            data: "message",
                            name: "message",
                        },
                        {
                            data: "status",
                            name: "status",
                            render: function(data) {
                                if (data == 1) return `<span class="badge badge-success">Replied</span>`
                                else return `<span class="badge badge-danger">New Message</span>`
                            }
                        },
                        {
                            data: "action",
                            name: "action",
                            orderable: true,
                            searchable: true
                        },
                    ]
                });
            })
        </script>
        <script>
            function getContactById(id) {
                let url = "{{ route('contact.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#modal_body").html(data);
                    }
                });
            }

            function deleteContactById(id) {
                let url = "{{ route('contact.delete', ':id') }}";
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

@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Pickup point</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pickupPointModal">
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
                                <h3 class="card-title">All Pickup Point List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Pickup Point Name</th>
                                            <th>Pickup Point Address</th>
                                            <th>Pickup Point Phone</th>
                                            <th>Pickup Point Another Phone</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <form id="delete_pickup_point" action="" method="delete">
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

    {{-- pickup point add model --}}
    <div class="modal fade" id="pickupPointModal" tabindex="-1" aria-labelledby="pickupPointModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warehouseModal">Add New Pickup Point</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pickup.point.store') }}" method="POST" id="add_pickup_point_form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pickup_point_name">Pickup Point Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pickup_point_name"
                                value="{{ old('pickup_point_name') }}" placeholder="Pickup Point Name" required>
                        </div>
                        <div class="form-group">
                            <label for="pickup_point_address">Pickup Point Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="pickup_point_address"
                                value="{{ old('pickup_point_address') }}" placeholder="Pickup Point Address" required>
                        </div>
                        <div class="form-group">
                            <label for="pickup_point_phone">Pickup Point Phone<span class="text-danger">*</span></label>
                            <input type="number" min="0" class="form-control" name="pickup_point_phone"
                                value="{{ old('pickup_point_phone') }}" placeholder="Pickup Point Phone" required>
                        </div>
                        <div class="form-group">
                            <label for="pickup_point_phone_two">Pickup Point Phone Two</label>
                            <input type="number" min="0" class="form-control" name="pickup_point_phone_two"
                                value="{{ old('pickup_point_phone_two') }}" placeholder="Pickup Point Phone Two">
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

    {{-- pickup point edit model --}}
    <div class="modal fade" id="editPickupPointModal" tabindex="-1" aria-labelledby="editPickupPointModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPickupPointModal">Edit Pickup Point</h5>
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
                    ajax: "{{ route('pickup.point.list') }}",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "pickup_point_name",
                            name: "pickup_point_name"
                        },
                        {
                            data: "pickup_point_address",
                            name: "pickup_point_address"
                        },
                        {
                            data: "pickup_point_phone",
                            name: "pickup_point_phone"
                        },
                        {
                            data: "pickup_point_phone_two",
                            name: "pickup_point_phone_two"
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

            $("#add_pickup_point_form").submit(function(e) {
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
                        $("#add_pickup_point_form")[0].reset();
                        $("#pickupPointModal").modal("hide");
                        $("button[type=submit]").attr('disabled', false);
                        table.ajax.reload();
                    },
                    error: function(error) {
                        $("button[type=submit]").attr('disabled', false);
                    }
                });
            });

            function getPickupPointById(id) {
                let url = "{{ route('pickup.point.edit', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#modal_body").html(data);
                    }
                });
            }

            function deletePickupPointById(id) {
                let url = "{{ route('pickup.point.delete', ':id') }}";
                url = url.replace(':id', id);

                var request = $("#delete_pickup_point").serialize();

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
                                    $("#delete_pickup_point")[0].reset();
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

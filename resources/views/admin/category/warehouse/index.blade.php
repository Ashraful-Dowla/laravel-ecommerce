@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Warehouse</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#warehouseModal">
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
                                <h3 class="card-title">All Warehouse List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Warehouse Name</th>
                                            <th>Warehouse Address</th>
                                            <th>Warehouse Phone</th>
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

    {{-- warehouse add model --}}
    <div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="warehouseModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="warehouseModal">Add New Warehouse</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('warehouse.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name">Warehouse Name</label>
                            <input type="text" class="form-control" name="warehouse_name"
                                value="{{ old('warehouse_name') }}" placeholder="Warehouse name" required>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Warehouse Address</label>
                            <textarea type="text" class="form-control" name="warehouse_address" value="{{ old('warehouse_address') }}"
                                placeholder="Warehouse address" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Warehouse Phone</label>
                            <input type="text" class="form-control" name="warehouse_phone"
                                value="{{ old('warehouse_phone') }}" placeholder="Warehouse phone" required>
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

    {{-- warehouse edit model --}}
    <div class="modal fade" id="editWarehouseModal" tabindex="-1" aria-labelledby="editWarehouseModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editWarehouseModal">Edit Warehouse</h5>
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
            $(function() {
                var table = $(".ytable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('warehouse.list') }}",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "warehouse_name",
                            name: "warehouse_name"
                        },
                        {
                            data: "warehouse_address",
                            name: "warehouse_address"
                        },
                        {
                            data: "warehouse_phone",
                            name: "warehouse_phone"
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

            function getWarehouseById(id) {
                let url = "{{ route('warehouse.edit', ':id') }}";
                url = url.replace(':id', id);

                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#modal_body").html(data);
                    }
                });
            }
        </script>
    @endpush
@endsection

@extends('layouts.admin')
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product</h1>
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
                                <h3 class="card-title">All Product List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-3">
                                        <label for="category_id">Category</label>
                                        <select name="category_id" class="form-control submitable" id="category_id">
                                            <option value="{{ null }}" selected>All</option>
                                            @foreach ($categories as $row)
                                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="brand_id">Brand</label>
                                        <select name="brand_id" class="form-control submitable" id="brand_id">
                                            <option value="{{ null }}" selected>All</option>
                                            @foreach ($brands as $row)
                                                <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="warehouse_id">Warehouse</label>
                                        <select name="warehouse_id" class="form-control submitable" id="warehouse_id">
                                            <option value="{{ null }}" selected>All</option>
                                            @foreach ($warehouses as $row)
                                                <option value="{{ $row->id }}">{{ $row->warehouse_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="product_status">Status</label>
                                        <select name="product_status" class="form-control submitable" id="product_status">
                                            <option value="{{ null }}" selected>All</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Thumbnail</th>
                                            <th>Name</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Brand</th>
                                            <th>Featured</th>
                                            <th>Today Deal</th>
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
                        url: "{{ route('product.list') }}",
                        data: function(e) {
                            e.category_id = $("#category_id").val();
                            e.brand_id = $("#brand_id").val();
                            e.warehouse_id = $("#warehouse_id").val();
                            e.product_status = $("#product_status").val();
                        }
                    },
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "product_thumbnail",
                            name: "product_thumbnail",
                            render: function(data) {
                                return `<img src=${data} width=40 height="40">`;
                            }
                        },
                        {
                            data: "product_name",
                            name: "product_name"
                        },
                        {
                            data: "product_code",
                            name: "product_code"
                        },
                        {
                            data: "category_name",
                            name: "category_name",
                        },
                        {
                            data: "subcategory_name",
                            name: "subcategory_name",
                        },
                        {
                            data: "brand_name",
                            name: "brand_name",
                        },
                        {
                            data: "product_featured",
                            name: "product_featured",
                        },
                        {
                            data: "product_today_deal",
                            name: "product_today_deal",
                        },
                        {
                            data: "product_status",
                            name: "product_status",
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
            // status ->  featured, today deal, status
            function productStatus(type, id, value) {
                let url = "{{ route('product.statusChange', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "POST",
                    async: false,
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    data: {
                        type: type,
                        value: value
                    },
                    success: function(data) {
                        toastr.success(data);
                        table.ajax.reload();
                    }
                })
            }

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

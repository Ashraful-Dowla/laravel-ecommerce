@extends('layouts.admin')
@section('admin_content')
    @push('css')
        <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css"
            integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
        <style type="text/css">
            .bootstrap-tagsinput .tag {
                background: #428bca;
                border: 1px solid white;
                padding: 1 6px;
                padding-left: 2px;
                margin-right: 2px;
                color: white;
                border-radius: 4px;
            }
        </style>
    @endpush

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Add product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-8">
                            <!-- general form elements -->
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Add New Product</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Product Name <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" name="product_name"
                                                value="{{ old('product_name') }}" required>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Product Code <span
                                                    class="text-danger">*</span>
                                            </label>
                                            <input type="text" class="form-control" value="{{ old('product_code') }}"
                                                name="product_code" required="">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Category/Subcategory <span
                                                    class="text-danger">*</span> </label>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id"
                                                onchange="getChildCategoryBySubCategoryId(this)">
                                                <option disabled selected>Choose Category/Subcategory</option>
                                                @foreach ($categories as $category)
                                                    @php
                                                        $subcategories = DB::table('subcategories')
                                                            ->where('category_id', $category->id)
                                                            ->get();
                                                    @endphp
                                                    <option style="color:blue;" disabled>{{ $category->category_name }}
                                                    </option>
                                                    @foreach ($subcategories as $subcategory)
                                                        <option value="{{ $subcategory->id }}">
                                                            ---{{ $subcategory->subcategory_name }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Child category<span
                                                    class="text-danger">*</span> </label>
                                            <select class="form-control" name="childcategory_id" id="childcategory_id">
                                                <option disabled selected>Choose Childcategory</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Brand</span>
                                            </label>
                                            <select class="form-control" name="brand_id">
                                                <option disabled selected>Choose Brand</option>
                                                @foreach ($brands as $row)
                                                    <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Pickup Point</label>
                                            <select class="form-control" name="pickup_point_id">
                                                <option disabled selected>Choose Pickup point</option>
                                                @foreach ($pickup_point as $row)
                                                    <option value="{{ $row->id }}">{{ $row->pickup_point_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Unit <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" class=form-control name="product_unit"
                                                value="{{ old('product_unit') }}" required="">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Tags</label><br>
                                            <input type="text" name="product_tags" class="form-control"
                                                value="{{ old('product_tags') }}" name="tags" data-role="tagsinput">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-4">
                                            <label for="exampleInput">Purchase Price </label>
                                            <input type="text" class="form-control" {{ old('product_purchase_price') }}
                                                name="product_purchase_price">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="exampleInput">Selling Price <span class="text-danger">*</span>
                                            </label>
                                            <input type="text" name="product_selling_price"
                                                value="{{ old('product_selling_price') }}" class="form-control"
                                                required="">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="exampleInput">Discount Price </label>
                                            <input type="text" name="product_discount_price"
                                                value="{{ old('product_discount_price') }}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Warehouse</span>
                                            </label>
                                            <select class="form-control" name="warehouse_id">
                                                <option disabled selected>Choose Warehouse</option>
                                                @foreach ($warehouses as $row)
                                                    <option value="{{ $row->id }}">
                                                        {{ $row->warehouse_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Stock</label>
                                            <input type="text" name="product_stock_quantity"
                                                value="{{ old('product_stock_quantity') }}" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputEmail1">Color</label><br>
                                            <input type="text" class="form-control"
                                                value="{{ old('product_color') }}" data-role="tagsinput"
                                                name="product_color" />
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="exampleInputPassword1">Size</label><br>
                                            <input type="text" class="form-control" value="{{ old('product_size') }}"
                                                data-role="tagsinput" name="product_size" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="exampleInputPassword1">Product Details</label>
                                            <textarea class="form-control textarea" id="summernote" name="product_description">{{ old('product_description') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="form-group col-lg-12">
                                            <label for="exampleInputPassword1">Video Embed Code</label>
                                            <input class="form-control" name="product_video"
                                                value="{{ old('product_video') }}"
                                                placeholder="Only code after embed word">
                                            <small class="text-danger">Only code after embed word</small>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.card -->
                        <!-- right column -->
                        <div class="col-md-4">
                            <!-- Form Element sizes -->
                            <div class="card card-primary">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Main Thumbnail <span class="text-danger">*</span>
                                        </label><br>
                                        <input type="file" name="product_thumbnail" required="" accept="image/*"
                                            class="dropify">
                                    </div><br>
                                    <div class="">
                                        <table class="table table-bordered" id="dynamic_field">
                                            <div class="card-header">
                                                <h3 class="card-title">More Images (Click Add For More Image)</h3>
                                            </div>
                                            <tr>
                                                <td><input type="file" accept="image/*" name="product_images[]"
                                                        class="form-control name_list" /></td>
                                                <td><button type="button" name="add" id="add"
                                                        class="btn btn-success">Add</button></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card p-4">
                                        <h6>Featured Product</h6>
                                        <input type="checkbox" name="product_featured" value="0"
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Today Deal</h6>
                                        <input type="checkbox" name="product_today_deal" value="0"
                                            data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Slider Product</h6>
                                        <input type="checkbox" name="product_slider" value="0" data-bootstrap-switch
                                            data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Trendy Product</h6>
                                        <input type="checkbox" name="product_trendy" value="0" data-bootstrap-switch
                                            data-off-color="danger" data-on-color="success">
                                    </div>

                                    <div class="card p-4">
                                        <h6>Status</h6>
                                        <input type="checkbox" name="product_status" value="0" data-bootstrap-switch
                                            data-off-color="danger" data-on-color="success">
                                    </div>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <button class="btn btn-info ml-2" type="submit">Submit</button>
                    </div>
                </form>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

    @push('script')
        <script src="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
        <script type="text/javascript"
            src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
        <script src="{{ asset('public/backend') }}/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
        <script type="text/javascript">
            $('#summernote').summernote();
            $('.dropify').dropify(); //dropify image
            $("input[data-bootstrap-switch]").each(function() {
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
            $(function() {
                var postURL = "<?php echo url('addmore'); ?>";
                var i = 1;
                $('#add').click(function() {
                    i++;
                    $('#dynamic_field').append('<tr id="row' + i +
                        '" class="dynamic-added"><td><input type="file" accept="image/*" name="product_images[]" class="form-control name_list" /></td><td><button type="button" name="remove" id="' +
                        i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
                });
                $(document).on('click', '.btn_remove', function() {
                    var button_id = $(this).attr("id");
                    $('#row' + button_id + '').remove();
                });
            });

            function getChildCategoryBySubCategoryId(object) {
                let id = object.value;
                let url = "{{ route('childcategory.getChildCategoryBySubCategoryId', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $("#childcategory_id").empty();
                        $('#childcategory_id').append(`<option selected disabled>Choose Childcategory</option>`);
                        data.map(({
                            id,
                            childcategory_name
                        }) => {
                            $('#childcategory_id').append(`<option value="${id}">
                           ${childcategory_name}
                      </option>`);
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection

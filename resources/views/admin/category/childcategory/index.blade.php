@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#childcategoryModal">
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
                                <h3 class="card-title">All Child Category List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Child Category Name</th>
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

    {{-- category add model --}}
    <div class="modal fade" id="childcategoryModal" tabindex="-1" aria-labelledby="childcategoryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">Add New Child Category</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action={{ route('childcategory.store') }} method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <select name="category_id" class="form-control" onchange="getSubcategoryByCategoryId(this)">
                                <option selected disabled>Choose Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Subcategory Name</label>
                            <select id="subcategory" name="subcategory_id" class="form-control">
                                <option selected disabled>Choose Subcategory</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category_name">Child Category Name</label>
                            <input type="text" class="form-control" name="childcategory_name"
                                value="{{ old('childcategory_name') }}" required>
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

    {{-- category edit model --}}
    <div class="modal fade" id="editChildCategoryModal" tabindex="-1" aria-labelledby="editChildCategoryModal"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">Edit Child Category</h5>
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
                    ajax: "{{ route('childcategory.list') }}",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "category_name",
                            name: "category_name"
                        },
                        {
                            data: "subcategory_name",
                            name: "subcategory_name"
                        },
                        {
                            data: "childcategory_name",
                            name: "childcategory_name"
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
            function getSubcategoryByCategoryId(object) {
                let id = object.value;
                let url = "{{ route('childcategory.getSubcategoryByCategoryId', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $("#subcategory").empty();
                        $('#subcategory').append(`<option selected disabled>Choose Subcategory</option>`);
                        data.map(({
                            id,
                            subcategory_name
                        }) => {
                            $('#subcategory').append(`<option value="${id}">
                           ${subcategory_name}
                      </option>`);
                        });
                    }
                });
            }

            function getChildCategoryDataById(id) {
                let url = "{{ route('childcategory.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#modal_body").html(data);
                    }
                });
            }

            function getEditSubcategoryByCategoryId(object) {
                let id = object.value;
                let url = "{{ route('childcategory.getSubcategoryByCategoryId', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $("#e_subcategory").empty();
                        $('#e_subcategory').append(`<option selected disabled>Choose Subcategory</option>`);
                        data.map(({
                            id,
                            subcategory_name
                        }) => {
                            $('#e_subcategory').append(`<option value="${id}">
                               ${subcategory_name}
                          </option>`);
                        });
                    }
                });
            }
        </script>
    @endpush
@endsection

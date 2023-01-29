@extends('layouts.admin')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" />
@endpush

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Blog Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#blogCategoryModal">
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
                                <h3 class="card-title">All Blog Category List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category Name</th>
                                            <th>Category Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($blog_categories as $key => $row)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $row->blog_category_name }}</td>
                                                <td>{{ $row->blog_category_slug }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-info btn-sm" data-toggle="modal"
                                                        data-target="#editBlogCategoryModal"
                                                        onclick="getBlogCategoryDataById(`{{ $row->id }}`)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('blog.category.delete', $row->id) }}"
                                                        class="btn btn-danger btn-sm" id="delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
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
    <div class="modal fade" id="blogCategoryModal" tabindex="-1" aria-labelledby="blogCategoryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">Add New Category</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action={{ route('blog.category.store') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="blog_category_name">Category Name</label>
                            <input type="text" class="form-control" id="blog_category_name" name="blog_category_name"
                                value="{{ old('blog_category_nameblog_') }}" required>
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
    <div class="modal fade" id="editBlogCategoryModal" tabindex="-1" aria-labelledby="editBlogCategoryModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">Edit Category</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action={{ route('blog.category.update') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category_name">Category Name</label>
                            <input type="hidden" class="form-control" id="e_category_id" name="id">
                            <input type="text" class="form-control" id="e_category_name" name="blog_category_name"
                                value="" required>
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

    <!-- script -->
    @push('script')
        <script>
            function getBlogCategoryDataById(id) {
                let url = "{{ route('blog.category.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: 'json',
                    success: function(data) {
                        $("#e_category_id").val(data.id);
                        $("#e_category_name").val(data.blog_category_name);
                    }
                });
            }
        </script>
    @endpush
@endsection

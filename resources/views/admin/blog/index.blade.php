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
                        <h1>Blog</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#blogModal">
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
                                <h3 class="card-title">All Blog List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Category</th>
                                            <th>Title</th>
                                            <th>Date</th>
                                            <th>Description</th>
                                            <th>Logo</th>
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

    {{-- blog add model --}}
    <div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">Add New Blog</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action={{ route('blog.store') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="brand_name">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name" value="{{ old('brand_name') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="brand_logo">Brand Logo</label>
                            <input type="file" class="dropify" name="brand_logo" required>
                        </div>
                        <div class="form-group">
                            <label for="front_page">Home Page</label>
                            <select name="front_page" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
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

    {{-- brand edit model --}}
    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">Edit Brand</h5>
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
            $(function() {
                var table = $(".ytable").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('blog.list') }}",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "blog_category_name",
                            name: "blog_category_name",
                        },
                        {
                            data: "title",
                            name: "title"
                        },
                        {
                            data: "date",
                            name: "date"
                        },
                        {
                            data: "description",
                            name: "description"
                        },
                        {
                            data: "logo",
                            name: "logo",
                            render: function(data, type, full, meta) {
                                return `<img src=${data} height="40">`;
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

            $('.dropify').dropify({
                messages: {
                    'default': 'Click here',
                    'replace': 'Drag and drop or click to replace',
                    'remove': 'Remove',
                    'error': 'Ooops, something wrong happended.'
                }
            });
        </script>
        <script>
            function getBrandById(id) {
                let url = "{{ route('brand.edit', ':id') }}";
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

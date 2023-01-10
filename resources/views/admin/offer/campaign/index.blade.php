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
                        <h1>Campaign</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#campaignModal">
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
                                <h3 class="card-title">All Campaign List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table class="table table-bordered table-striped table-sm ytable">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Title</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Image</th>
                                            <th>Discount(%)</th>
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

    {{-- campaign add model --}}
    <div class="modal fade" id="campaignModal" tabindex="-1" aria-labelledby="campaignModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="campaignModal">Add New Campaign</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action={{ route('campaign.store') }} method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="campaign_title">Campaign Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="campaign_title"
                                value="{{ old('campaign_title') }}" required>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="campaign_start_date">Campaign Start Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="campaign_start_date" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="campaign_end_date">Campaign End Date <span
                                            class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="campaign_end_date" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="campaign_status">Campaign Status</label>
                                    <select name="campaign_status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="campaign_discount">Campaign Discount <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="campaign_discount"
                                        value="{{ old('campaign_discount') }}" required>
                                    <small class="form-text text-danger">Discount percentage are apply for all product
                                        selling price</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="campaign_image">Campaign Logo<span class="text-danger">*</span></label>
                            <input type="file" class="dropify" name="campaign_image" required>
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

    {{-- campaign edit model --}}
    <div class="modal fade" id="editCampaignModal" tabindex="-1" aria-labelledby="editCampaignModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModal">Edit Campaign</h5>
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
                    ajax: "{{ route('campaign.list') }}",
                    columns: [{
                            data: "DT_RowIndex",
                            name: "DT_RowIndex"
                        },
                        {
                            data: "campaign_title",
                            name: "campaign_title"
                        },
                        {
                            data: "campaign_start_date",
                            name: "campaign_start_date"
                        },
                        {
                            data: "campaign_end_date",
                            name: "campaign_end_date",

                        },
                        {
                            data: "campaign_image",
                            name: "campaign_image",
                            render: function(data, type, full, meta) {
                                return `<img src=${data} height="40">`;
                            }
                        },
                        {
                            data: "campaign_discount",
                            name: "campaign_discount"
                        },
                        {
                            data: "campaign_status",
                            name: "campaign_status",
                            render: function(data) {
                                return `<a href="#">
                                            <span class="badge badge-${ data ? 'success' : 'danger' }">${ data ? 'active' : 'inactive' }</span>
                                        </a>`;

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
            function getCampaignById(id) {
                let url = "{{ route('campaign.edit', ':id') }}";
                url = url.replace(':id', id);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#modal_body").html(data);
                    }
                });
            }

            function deleteCampaignById(id) {
                let url = "{{ route('campaign.delete', ':id') }}";
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

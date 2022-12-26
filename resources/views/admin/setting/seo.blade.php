@extends('layouts.admin')

@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Admin Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">OnPage SEO</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Your SEO Settings</h3>
                            </div>
                            <form action="{{ route('seo.setting.update', $seo_data->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="meta_title">Meta Title</label>
                                                <input type="text" class="form-control" id="meta_title"
                                                    placeholder="Meta Title" name="meta_title"
                                                    value="{{ $seo_data->meta_title }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_author">Meta Author</label>
                                                <input type="text" class="form-control" id="meta_author"
                                                    placeholder="Meta Author" name="meta_author"
                                                    value="{{ $seo_data->meta_author }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_tag">Meta Tag</label>
                                                <input type="text" class="form-control" id="meta_tag"
                                                    placeholder="Meta Tag" name="meta_tag"
                                                    value="{{ $seo_data->meta_tag }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="meta_keyword">Meta Keyword</label>
                                                <input type="text" class="form-control" id="meta_keyword"
                                                    placeholder="Example: ecommerce, online shop, online market"
                                                    name="meta_keyword" value="{{ $seo_data->meta_keyword }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="google_verification">Google Verification</label>
                                                <input type="text" class="form-control" id="google_verification"
                                                    placeholder="Pute here only Google Verification code"
                                                    name="google_verification" value="{{ $seo_data->google_verification }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="google_analytics">Google Analytics</label>
                                                <input type="text" class="form-control" id="google_analytics"
                                                    placeholder="Google Analytics" name="google_analytics"
                                                    value="{{ $seo_data->google_analytics }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="google_adsense">Google Adsense</label>
                                                <input type="text" class="form-control" id="google_adsense"
                                                    placeholder="Google Adsense" name="google_adsense"
                                                    value="{{ $seo_data->google_adsense }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="alexa_verification">Alexa Verification</label>
                                                <input type="text" class="form-control" id="alexa_verification"
                                                    placeholder="Alexa Verification" name="alexa_verification"
                                                    value="{{ $seo_data->alexa_verification }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="meta_description">Meta Description</label>
                                                <textarea type="text" class="form-control" id="meta_description" placeholder="Meta Description"
                                                    name="meta_description">{{ $seo_data->meta_description }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

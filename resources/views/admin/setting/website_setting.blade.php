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
                            <li class="breadcrumb-item active">Website Setting</li>
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
                                <h3 class="card-title">Website Setting</h3>
                            </div>
                            <form action="{{ route('website.setting.update', $website_data->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="meta_title">Currency </label>
                                                <select name="currency" class="form-control">
                                                    <option value="৳"
                                                        {{ $website_data->currency == '৳' ? 'selected' : null }}>Taka (৳)
                                                    </option>
                                                    <option value="$"
                                                        {{ $website_data->currency == '$' ? 'selected' : null }}>USD ($)
                                                    </option>
                                                    <option value="$"
                                                        {{ $website_data->currency == '₹' ? 'selected' : null }}>Rupee (₹)
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_one">Phone one</label>
                                                <input type="text" class="form-control" id="phone_one"
                                                    placeholder="Phone one" name="phone_one"
                                                    value="{{ $website_data->phone_one }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone_two">Phone two</label>
                                                <input type="text" class="form-control" id="phone_two"
                                                    placeholder="Phone two" name="phone_two"
                                                    value="{{ $website_data->phone_two }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="main_email">Main Email</label>
                                                <input type="email" class="form-control" id="main_email"
                                                    placeholder="Main Email" name="main_email"
                                                    value="{{ $website_data->main_email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="support_email">Support Email</label>
                                                <input type="email" class="form-control" id="support_email"
                                                    placeholder="Support Email" name="support_email"
                                                    value="{{ $website_data->support_email }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="logo">Logo</label>
                                                <input type="file" class="form-control" id="logo" name="logo">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="facebook">Facebook</label>
                                                <input type="text" class="form-control" id="facebook"
                                                    placeholder="Facebook link" name="facebook"
                                                    value="{{ $website_data->facebook }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="twitter">Twitter</label>
                                                <input type="text" class="form-control" id="twitter"
                                                    placeholder="Twitter link" name="twitter"
                                                    value="{{ $website_data->twitter }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="linkedin">Linkedin</label>
                                                <input type="text" class="form-control" id="linkedin"
                                                    placeholder="Linkedin link" name="linkedin"
                                                    value="{{ $website_data->linkedin }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="youtube">Youtube</label>
                                                <input type="text" class="form-control" id="youtube"
                                                    placeholder="Youtube link" name="youtube"
                                                    value="{{ $website_data->youtube }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="instagram">Instagram</label>
                                                <input type="text" class="form-control" id="instagram"
                                                    placeholder="Instagram link" name="instagram"
                                                    value="{{ $website_data->instagram }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="favicon">Favicon</label>
                                                <input type="file" class="form-control" id="favicon"
                                                    name="favicon">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea type="text" class="form-control" id="address" placeholder="Address" name="address">{{ $website_data->address }}</textarea>
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

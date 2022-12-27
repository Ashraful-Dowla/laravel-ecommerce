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
                            <li class="breadcrumb-item active">SMTP Mail</li>
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
                                <h3 class="card-title">Your SMTP Settings</h3>
                            </div>
                            <form action="{{ route('smtp.setting.update', $smtp_data->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mailer">Mail Mailer</label>
                                                <input type="text" class="form-control" id="mailer"
                                                    placeholder="Mail Mailer" name="mailer"
                                                    value="{{ $smtp_data->mailer }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="host">Mail Host</label>
                                                <input type="text" class="form-control" id="host"
                                                    placeholder="Mail host" name="host" value="{{ $smtp_data->host }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="port">Mail Port</label>
                                                <input type="text" class="form-control" id="port"
                                                    placeholder="Mail port" name="port" value="{{ $smtp_data->port }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_name">Mail Username</label>
                                                <input type="text" class="form-control" id="user_name"
                                                    placeholder="Mail username" name="user_name"
                                                    value="{{ $smtp_data->user_name }}">
                                            </div>
                                            <div class="form-group">
                                                <label for="password">Mail Password</label>
                                                <input type="password" class="form-control" id="password"
                                                    placeholder="Mail password" name="password"
                                                    value="{{ $smtp_data->password }}">
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

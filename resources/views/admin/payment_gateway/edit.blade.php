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
                            <li class="breadcrumb-item active">Payment Gateway</li>
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
                                <h3 class="card-title">Aamary Payment Gateway</h3>
                            </div>
                            <form action="{{ route('payment.gateway.update', $aamar_pay->id) }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="store_id">Store ID</label>
                                                <input type="text" class="form-control" id="store_id"
                                                    placeholder="Store ID" name="store_id"
                                                    value="{{ $aamar_pay->store_id }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="signature_key">Signature Key</label>
                                                <input type="text" class="form-control" id="signature_key"
                                                    placeholder="Signature Key" name="signature_key"
                                                    value="{{ $aamar_pay->signature_key }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="status">Live server</label>
                                                <input type="checkbox"  id="status" name="status"
                                                    {{ $aamar_pay->status == 1 ? 'checked' : null }}>
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

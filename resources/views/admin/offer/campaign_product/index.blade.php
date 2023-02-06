@extends('layouts.admin')
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>All Products for Campaign</h1>
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
                                <h3 class="card-title">Product List</h3>
                                <a class="btn btn-primary" style="float: right;"
                                    href="{{ route('campaign.product.list', $campaign_id) }}">Product List</a>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th>SL</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Code</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $row)
                                            @php
                                                $exists = DB::table('campaign_products')
                                                    ->where('campaign_id', $campaign_id)
                                                    ->where('product_id', $row->id)
                                                    ->first();
                                            @endphp
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $row->product_name }}</td>
                                                <td><img src="{{ asset($row->product_thumbnail) }}" height="32"
                                                        width="32"></td>
                                                <td>{{ $row->product_code }}</td>
                                                <td>{{ $row->category->category_name }}</td>
                                                <td>{{ $row->brand == null ? 'Unknown' : $row->brand->brand_name }}</td>
                                                <td>{{ $row->product_selling_price }}</td>
                                                <td>
                                                    @if (!$exists)
                                                        <a href="{{ route('campaign.product.store', [$row->id, $campaign_id]) }}"
                                                            class="btn btn-success btn-sm">
                                                            <i class="fa fa-plus"></i>
                                                        </a>
                                                    @endif
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
@endsection

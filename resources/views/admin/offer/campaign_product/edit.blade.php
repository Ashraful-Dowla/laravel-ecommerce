@extends('layouts.admin')
@section('admin_content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Campaign: {{ $campaign->campaign_title }}</h1>
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
                                        @foreach ($campaign_products as $key => $row)
                                            <tr>
                                                <td>{{ $key }}</td>
                                                <td>{{ $row->product->product_name }}</td>
                                                <td><img src="{{ asset($row->product->product_thumbnail) }}" height="32"
                                                        width="32"></td>
                                                <td>{{ $row->product->product_code }}</td>
                                                <td>{{ $row->product->category->category_name }}</td>
                                                <td>{{ $row->product->brand == null ? 'Unknown' : $row->product->brand->brand_name }}
                                                </td>
                                                <td>{{ $row->price }}</td>
                                                <td>
                                                    <a href="{{ route('campaign.product.delete', $row->id) }}"
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
@endsection

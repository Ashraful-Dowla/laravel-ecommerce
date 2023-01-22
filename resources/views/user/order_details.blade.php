@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                @include('user.sidebar')
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                    </div>

                    <div class="card-body">
                        <h4>My Orders</h4>
                        <div class="mt-2 mb-2">
                            <div class="row">
                                <div class="col-md-4 mb-2">Name: {{ $order->c_name }}</div>
                                <div class="col-md-4 mb-2">Phone: {{ $order->c_phone }}</div>
                                <div class="col-md-4 mb-2">Email: {{ $order->c_email }}</div>
                                <div class="col-md-4 mb-2">Subtotal:{{ $setting->currency }} {{ $order->subtotal }}</div>
                                <div class="col-md-4 mb-2">Total:{{ $setting->currency }} {{ $order->total }}</div>
                                <div class="col-md-4 mb-2">
                                    Status:
                                    @if ($order->status == 0)
                                        <span class="badge badge-danger">Order Pending</span>
                                    @elseif($order->status == 1)
                                        <span class="badge badge-info">Order Recieved</span>
                                    @elseif($order->status == 2)
                                        <span class="badge badge-primary">Order Shipped</span>
                                    @elseif($order->status == 3)
                                        <span class="badge badge-success">Order Done</span>
                                    @elseif($order->status == 4)
                                        <span class="badge badge-warning">Order Return</span>
                                    @elseif($order->status == 5)
                                        <span class="badge badge-danger">Order Cancel</span>
                                    @endif
                                </div>
                                <div class="col-md-4 mb-2">
                                    Date: {{ date('d F , Y', strtotime($order->date)) }}
                                </div>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order_details as $key => $row)
                                        <tr>
                                            <td>{{ ++$key }}</th>
                                            <td>{{ $row->product_name }}</th>
                                            <td>{{ $row->product_color ?? '-' }}</td>
                                            <td>{{ $row->product_size ?? '-' }}</td>
                                            <td>{{ $row->product_quantity }}</td>
                                            <td> {{ $setting->currency }} {{ $row->product_price }}</td>
                                            <td> {{ $setting->currency }} {{ $row->subtotal }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection

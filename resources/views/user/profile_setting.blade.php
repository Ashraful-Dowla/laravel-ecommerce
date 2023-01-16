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
                        <a href="{{ route('review.website') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a
                            review</a>
                    </div>

                    <div class="card-body">
                        <h4 class="text-center">Your default credentials setting</h4>
                        <form action="{{ route('review.website.store') }}" method="POST">
                            @csrf
                            <div class="form-group row m-3">
                                <div class="col-md-6">
                                    <label for="name">Shipping Name</label>
                                    <input type="text" class="form-control" id="name" name="shipping_name"
                                        aria-describedby="emailHelp" value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="shipping_phone">Shipping Phone</label>
                                    <input type="text" class="form-control" id="shipping_phone" name="shipping_phone"
                                        aria-describedby="emailHelp" value="">
                                </div>
                            </div>
                            <div class="form-group row m-3 col-md-12">
                                <label for="shipping_address">Shipping Address</label>
                                <textarea type="text" class="form-control" id="shipping_address" name="shipping_address" aria-describedby="emailHelp"
                                    value=""></textarea>
                            </div>
                            <div class="form-group row m-3">
                                <div class="col-md-6">
                                    <label for="shipping_email">Shipping Country</label>
                                    <input type="text" class="form-control" id="shipping_email" name="shipping_email"
                                        aria-describedby="emailHelp" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="shipping_country">Shipping Country</label>
                                    <input type="text" class="form-control" id="shipping_country" name="shipping_country"
                                        aria-describedby="emailHelp" value="">
                                </div>
                            </div>
                            <div class="form-group row m-3">
                                <div class="col-md-6">
                                    <label for="shipping_city">Shipping City</label>
                                    <input type="text" class="form-control" id="shipping_city" name="shipping_city"
                                        aria-describedby="emailHelp" value="">
                                </div>
                                <div class="col-md-6">
                                    <label for="shipping_zipcode">Shipping Zipcode</label>
                                    <input type="text" class="form-control" id="shipping_zipcode" name="shipping_zipcode"
                                        aria-describedby="emailHelp" value="">
                                </div>
                            </div>
                            <div class="row m-3 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit Review</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <h4 class="text-center">Change Your Password</h4>
                        <form action="{{ route('customer.password.change') }}" method="POST">
                            @csrf
                            <div class="form-group row m-3">
                                <label for="current_password">Current Password</label>
                                <input type="password" class="form-control" id="current_password" name="current_password"
                                    required placeholder="Current Password">
                            </div>
                            <div class="form-group row m-3">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required placeholder="New password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group row m-3">
                                <label for="password_confirmation">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required placeholder="Retype new password">
                            </div>
                            <div class="row m-3 col-md-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection

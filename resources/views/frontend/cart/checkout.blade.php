@extends('layouts.app')

@section('navbar')
    @include('layouts.partial.front.main_navbar')
@endsection

@push('front_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">
@endpush

@section('content')
    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart_container">
                        <div class="cart_title">Billing Address</div>
                        <div class="cart_items">
                            <form action="{{ route('order.place') }}" method="POST" id="billing_form">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="c_name">Customer Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('c_name') is-invalid @enderror"
                                            name="c_name" value="{{ Auth::user()->name }}" required
                                            value="{{ old('c_name') }}">
                                        @error('c_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="c_email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control @error('c_name') is-invalid @enderror" F
                                            name="c_email" required value="{{ old('c_email') }}">
                                        @error('c_email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="c_country">Country <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('c_name') is-invalid @enderror" F
                                            name="c_country" required value="{{ old('c_country') }}">
                                        @error('c_country')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="c_phone">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="c_phone"
                                            value="{{ Auth::user()->phone }}" required value="{{ old('c_phone') }}">
                                        @error('c_phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="c_phone_2">Phone 2</label>
                                        <input type="text" class="form-control @error('c_name') is-invalid @enderror" F
                                            name="c_phone_2" value="{{ old('c_phone_2') }}">
                                        @error('c_phone_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="c_city">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" name="c_city" required
                                            value="{{ old('c_city') }}">
                                        @error('c_city')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="c_zipcode">Zipcode <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('c_name') is-invalid @enderror" F
                                            name="c_zipcode" required value="{{ old('c_zipcode') }}">
                                        @error('c_zipcode')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="c_address">Shipping Address <span class="text-danger">*</span></label>
                                        <textarea type="text" class="form-control @error('c_name') is-invalid @enderror"F name="c_address">{{ old('c_address') }}</textarea>
                                        @error('c_address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="c_address_2">Shipping Address 2(Optional)</label>
                                        <textarea type="text" class="form-control" name="c_address_2">{{ old('c_address_2') }}</textarea>
                                        @error('c_address_2')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <h3>Select Payment Type </h3>
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="payment_type">Paypal</label>
                                        <input type="radio" class="form-control @error('c_name') is-invalid @enderror" F
                                            name="payment_type" checked value="Paypal">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="payment_type">SSL Commerz</label>
                                        <input type="radio" class="form-control @error('c_name') is-invalid @enderror" F
                                            name="payment_type" value="SSL Commerz">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="payment_type">Cash</label>
                                        <input type="radio" class="form-control @error('c_name') is-invalid @enderror" F
                                            name="payment_type" value="Cash">
                                    </div>
                                    <div class="form-group col-lg-12">
                                        <button type="submit" class="btn btn-info">Order Place</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Order Total -->
                    </div>
                </div>
                <div class="col-lg-4" style="margin-top: 120px;">
                    <div class="card">
                        <div class="pl-4 pt-2">
                            <p style="color: black;">Subtotal: <span style="float: right; padding-right: 5px;">
                                    {{ $setting->currency }}&nbsp;{{ Cart::subtotal() }}</span> </p>
                        </div>
                        @if (Session::has('coupon'))
                            <div class="pl-4 pt-2">
                                <p style="color: black;">Coupon:({{ Session::get('coupon')['code'] }}) <span
                                        style="float: right; padding-right: 5px;">
                                        {{ $setting->currency }}&nbsp; {{ Session::get('coupon')['discount'] }}</span></p>
                                <a href="{{ route('coupon.remove') }}" class="text-danger"
                                    style="float: right; padding-right: 5px;">coupon
                                    remove</a>
                            </div>
                        @endif
                        <div class="pl-4 pt-2">
                            <p style="color: black;">Tax: <span style="float: right; padding-right: 5px;">
                                    00.00%</span> </p>
                        </div>
                        <div class="pl-4 pt-2">
                            <p style="color: black;">Shipping: <span style="float: right; padding-right: 5px;">
                                    {{ $setting->currency }}&nbsp;00.00</span> </p>
                        </div>
                        <div class="pl-4 pt-2">
                            <p style="color: black;">Total: <span style="float: right; padding-right: 5px;">
                                    {{ $setting->currency }}&nbsp;{{ Session::get('coupon')['after_discount'] ?? Cart::total() }}</span>
                            </p>
                        </div>
                        @if (!Session::has('coupon'))
                            <form action="{{ route('coupon.apply') }}" method="POST">
                                @csrf
                                <div class="form-group m-3">
                                    <label for="coupoun">Coupon Apply</label>
                                    <input type="text" class="form-control" name="coupoun_code"
                                        placeholder="Coupon Code" autocomplete="off">
                                </div>
                                <div class="form-group m-3">
                                    <button type="submit" class="btn btn-info">Apply Coupon</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_script')
    <script src="{{ asset('public/frontend') }}/js/cart_custom.js"></script>
    <script>
        function removeProductById(rowId) {
            let url = "{{ route('cart.product.remove', ':id') }}";
            url = url.replace(':id', rowId);

            $.ajax({
                type: "DELETE",
                async: false,
                url: url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function(data) {
                    toastr.success(data);
                    window.location.reload();
                }
            })
        }

        $("#billing_form").submit(function(e) {
            e.preventDefault();
            let url = $(this).attr('action');
            let request = $(this).serialize();

            $("button[type=submit]").attr('disabled', true);

            $.ajax({
                type: "POST",
                url: url,
                async: false,
                data: request,
                success: function(data) {
                    toastr.success(data);
                    $("#billing_form")[0].reset();
                    $("button[type=submit]").attr('disabled', false);
                    window.location.reload();
                },
                error: function(error) {
                    $("button[type=submit]").attr('disabled', false);
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    </script>
@endpush

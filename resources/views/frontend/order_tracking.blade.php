@extends('layouts.app')

@section('navbar')
    @push('front_css')
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
    @endpush
    @include('layouts.partial.front.collapse_navbar')
    @push('front_script')
        <script src="{{ asset('public/frontend') }}/js/product_custom.js"></script>
    @endpush
@endsection

@section('content')
    <!-- Shop -->
    @push('front_css')
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
        <link rel="stylesheet" type="text/css"
            href="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_responsive.css">
    @endpush

    <!-- Home -->

    <div class="home">
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">Track your order now</h2>
        </div>
    </div>
    <div class="shop">
        <div class="container">
            <div class="row justify-content-center">
                <div class="card card-body col-lg-6 col-lg-offset-3">
                    <form action="{{ route('order.check') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Order ID</label>
                            <input type="text" name="order_id" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Track</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('front_script')
        <script src="{{ asset('public/frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
        <script src="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
        <script src="{{ asset('public/frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
        <script src="{{ asset('public/frontend') }}/js/shop_custom.js"></script>
    @endpush
@endsection

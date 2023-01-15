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
            <h2 class="home_title">{{ $brand->brand_name }}</h2>
        </div>
    </div>
    <div class="brands">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach ($brands as $row)
                                <div class="owl-item">
                                    <div class="brands_item d-flex flex-column justify-content-center">
                                        <a href="{{ route('brandwise.product', $row->id) }}"
                                            title="{{ $row->brand_name }}">
                                            <img src="{{ asset($row->brand_logo) }}" alt="{{ $row->brand_name }}"
                                                height="50" width="40">
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    <!-- Shop Sidebar -->
                    <div class="shop_sidebar">
                        <div class="sidebar_section">
                            <div class="sidebar_title">Categories</div>
                            <ul class="sidebar_categories">
                                @foreach ($categories as $row)
                                    <li><a
                                            href="{{ route('categorywise.product', $row->id) }}">{{ $row->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="sidebar_section filter_by_section">
                            <div class="sidebar_title">Filter By</div>
                            <div class="sidebar_subtitle">Price</div>
                            <div class="filter_price">
                                <div id="slider-range" class="slider_range"></div>
                                <p>Range: </p>
                                <p><input type="text" id="amount" class="amount" readonly
                                        style="border:0; font-weight:bold;"></p>
                            </div>
                        </div>
                        <div class="sidebar_section">
                            <div class="sidebar_subtitle color_subtitle">Color</div>
                            <ul class="colors_list">
                                <li class="color"><a href="#" style="background: #b19c83;"></a></li>
                                <li class="color"><a href="#" style="background: #000000;"></a></li>
                                <li class="color"><a href="#" style="background: #999999;"></a></li>
                                <li class="color"><a href="#" style="background: #0e8ce4;"></a></li>
                                <li class="color"><a href="#" style="background: #df3b3b;"></a></li>
                                <li class="color"><a href="#"
                                        style="background: #ffffff; border: solid 1px #e1e1e1;"></a></li>
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-9">

                    <!-- Shop Content -->

                    <div class="shop_content">
                        <div class="shop_bar clearfix">
                            <div class="shop_product_count"><span>{{ count($categorywise_products) }}</span> products
                                found</div>
                            <div class="shop_sorting">
                                <span>Sort by:</span>
                                <ul>
                                    <li>
                                        <span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
                                        <ul>
                                            <li class="shop_sorting_button"
                                                data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
                                            <li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>
                                                name
                                            </li>
                                            <li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>
                                                price
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product_grid">
                            <div class="product_grid_border"></div>

                            <!-- Product Item -->
                            @forelse ($categorywise_products as $row)
                                <div class="product_item is_new">
                                    <div class="product_border"></div>
                                    <div
                                        class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset($row->product_thumbnail) }}" alt="{{ $row->product_name }}"
                                            height="90%" width="70%">
                                    </div>
                                    <div class="product_content">
                                        @if ($row->product_discount_price != null)
                                            <div class="product_price discount viewed_price">
                                                {{ $setting->currency }}{{ $row->product_discount_price }}<span>
                                                    <small>{{ $setting->currency }}{{ $row->product_selling_price }}</small></span>
                                            </div>
                                        @else
                                            <div class="product_price">
                                                {{ $setting->currency }}{{ $row->product_selling_price }}
                                            </div>
                                        @endif
                                        <div class="product_name">
                                            <div><a href="{{ route('product.details', $row->product_slug) }}"
                                                    tabindex="0">{{ substr($row->product_name, 0, 15) }}</a></div>
                                        </div>
                                    </div>
                                    <a href="{{ route('wishlist.store', $row->id) }}">
                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                    </a>
                                </div>
                            @empty
                                <p>No product found</p>
                            @endforelse


                        </div>

                        <!-- Shop Page Navigation -->

                        <div class="shop_page_nav d-flex flex-row">
                            <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i
                                    class="fas fa-chevron-left"></i></div>
                            <ul class="page_nav d-flex flex-row">
                                {{ $categorywise_products->links() }}
                            </ul>
                            <div class="page_next d-flex flex-column align-items-center justify-content-center"><i
                                    class="fas fa-chevron-right"></i></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Products For You</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                            <!-- Recently Viewed Item -->
                            @foreach ($random_products as $row)
                                <div class="owl-item">
                                    <div
                                        class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="viewed_image"><img src="{{ asset($row->product_thumbnail) }}"
                                                alt="{{ $row->product_name }}">
                                        </div>
                                        <div class="viewed_content text-center">
                                            <div class="viewed_price">
                                                @if ($row->product_discount_price != null)
                                                    <div class="discount viewed_price">
                                                        {{ $setting->currency }}{{ $row->product_discount_price }}<span>
                                                            <small>{{ $setting->currency }}{{ $row->product_selling_price }}</small></span>
                                                    </div>
                                                @else
                                                    <div>
                                                        {{ $setting->currency }}{{ $row->product_selling_price }}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="viewed_name"><a
                                                    href="{{ route('product.details', $row->product_slug) }}">{{ substr($row->product_name, 0, 15) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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

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
            <h2 class="home_title">{{ $campaign->campaign_title }}</h2>
        </div>
    </div>
    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">

                    <!-- Shop Content -->
                    @php
                        $campaign_products = \App\Models\CampaignProduct::where('campaign_id', $campaign->id)->get();
                    @endphp
                    <div class="shop_content">
                        <div class="shop_bar clearfix">
                            <div class="shop_product_count"><span>{{ count($campaign_products) }}</span> products
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
                            @forelse ($campaign_products as $row)
                                <div class="product_item is_new">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset($row->product->product_thumbnail) }}"
                                            alt="{{ $row->product->product_name }}" height="90%" width="70%">
                                    </div>
                                    <div class="product_content">
                                        <div class="product_name">
                                            <div><a href="{{ route('frontend.campaign.product.details', [$campaign->id, $row->product->product_slug]) }}"
                                                    tabindex="0">{{ substr($row->product->product_name, 0, 15) }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No product found</p>
                            @endforelse


                        </div>

                        <!-- Shop Page Navigation -->

                        {{-- <div class="shop_page_nav d-flex flex-row">
                            <div class="page_prev d-flex flex-column align-items-center justify-content-center"><i
                                    class="fas fa-chevron-left"></i></div>
                            <ul class="page_nav d-flex flex-row">
                                {{ $categorywise_products->links() }}
                            </ul>
                            <div class="page_next d-flex flex-column align-items-center justify-content-center"><i
                                    class="fas fa-chevron-right"></i></div>
                        </div> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->
    @push('front_script')
        <script src="{{ asset('public/frontend') }}/plugins/Isotope/isotope.pkgd.min.js"></script>
        <script src="{{ asset('public/frontend') }}/plugins/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
        <script src="{{ asset('public/frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
        <script src="{{ asset('public/frontend') }}/js/shop_custom.js"></script>
    @endpush
@endsection

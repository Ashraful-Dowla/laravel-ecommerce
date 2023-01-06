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
    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        @foreach (json_decode($product->product_images) as $file_path)
                            <li data-image="{{ asset($file_path) }}"><img src="{{ asset($file_path) }}" alt=""></li>
                        @endforeach
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-4 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset($product->product_thumbnail) }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-3 order-3">
                    <div class="product_description">
                        <div class="product_category">{{ $product->category->category_name }} >
                            {{ $product->subcategory->subcategory_name }}</div>
                        <div class="product_name" style="font-size: 20px;">{{ $product->product_name }}</div>
                        <div class="product_category">Brand: <b>{{ $product->brand->brand_name }}</b></div>
                        <div class="product_category">Stock: <b>{{ $product->product_stock_quantity }}</b></div>
                        <div class="product_category">Unit: <b>{{ $product->product_unit }}</b></div>
                        <div>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star "></span>
                        </div>
                        @if ($product->product_discount_price == null)
                            <div class="product_price mt-4">{{ $setting->currency }}{{ $product->product_selling_price }}
                            </div>
                        @else
                            <div class="product_price mt-4">
                                <del class="text-danger pr-1">{{ $setting->currency }}{{ $product->product_selling_price }}
                                </del>{{ $setting->currency }}{{ $product->product_discount_price }}
                            </div>
                        @endif
                        {{-- <div class="rating_r rating_r_4 product_rating"><i></i><i></i><i></i><i></i><i></i></div> --}}
                        {{-- <div class="product_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis,
                                nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus
                                cursus urna, eget dictum lacus turpis.</p>
                        </div> --}}
                        <div class="order_info d-flex flex-row">
                            <form action="#">
                                <div class="clearfix" style="z-index: 1000;">
                                    <div class="form-group">
                                        <div class="row">
                                            @isset($product->product_size)
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="">Pick Size</label>
                                                        <select name="product_size" class="form-control">
                                                            @foreach (explode(',', $product->product_size) as $size)
                                                                <option value="{{ $size }}">{{ $size }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @endif
                                                @isset($product->product_color)
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="product_color">Pick Color</label>
                                                            <select name="product_color" class="form-control">
                                                                @foreach (explode(',', $product->product_color) as $color)
                                                                    <option value="{{ $color }}">{{ $color }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- Product Quantity -->
                                            <div class="product_quantity clearfix">
                                                <span>Quantity: </span>
                                                <input id="quantity_input" type="text" pattern="[0-9]*" value="1">
                                                <div class="quantity_buttons">
                                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i
                                                            class="fas fa-chevron-up"></i></div>
                                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i
                                                            class="fas fa-chevron-down"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button_container">
                                            <button type="button" class="button cart_button">Add to Cart</button>
                                            <div class="product_fav"><i class="fas fa-heart"></i></div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 order-3" style="border-left: 1px solid grey; padding-left: 10px;">
                            <strong class="text-muted">Pickup Point of this product</strong><br>
                            <i class="fa fa-map"> {{ $product->pickuppoint->pickup_point_name }} </i>
                            <hr><br>
                            <strong class="text-muted"> Home Delivery :</strong><br>
                            -> (4-8) days after the order placed.<br>
                            -> Cash on Delivery Available.
                            <hr><br>
                            <strong class="text-muted"> Product Return & Warrenty :</strong><br>
                            -> 7 days return guarranty.<br>
                            -> Warrenty not available.
                            <hr><br>
                            @isset($product->product_video)
                                <strong>Product Video : </strong>
                                <iframe width="340" height="205" src="https://www.youtube.com/embed/{{ $product->product_video }}"
                                    title="YouTube video player" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            @endisset
                        </div>
                    </div>
                    <br /><br />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Product details of {{ $product->product_name }}</h4>
                                </div>
                                <div class="card-body">
                                    {!! $product->product_description !!}
                                </div>
                            </div>
                        </div>
                    </div><br />
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Ratings & Reviews of {{ $product->product_name }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            Average Review of {{ $product->product_name }}:<br>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                            <span class="fa fa-star checked"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Related Product -->

                    <div class="viewed">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="viewed_title_container">
                                        <h3 class="viewed_title">Related Product</h3>
                                        <div class="viewed_nav_container">
                                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                                        </div>
                                    </div>

                                    <div class="viewed_slider_container">

                                        <!-- Recently Viewed Slider -->

                                        <div class="owl-carousel owl-theme viewed_slider">
                                            <!-- Recently Viewed Item -->
                                            @foreach ($related_products as $row)
                                                <div class="owl-item">
                                                    <div
                                                        class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                        <div class="viewed_image"><img src="{{ asset($row->product_thumbnail) }}"
                                                                alt=""></div>
                                                        <div class="viewed_content text-center">
                                                            @if ($row->product_discount_price != null)
                                                                <div class="viewed_price">
                                                                    {{ $setting->currency }}{{ $row->product_discount_price }}<span>
                                                                        <small>{{ $setting->currency }}{{ $row->product_selling_price }}</small></span>
                                                                </div>
                                                            @else
                                                                <div class="viewed_price">
                                                                    <span>{{ $setting->currency }}{{ $row->product_selling_price }}</span>
                                                                </div>
                                                            @endif
                                                            <div class="viewed_name"><a
                                                                    href="#">{{ substr($row->product_name, 0, 15) }}</a>
                                                            </div>
                                                        </div>
                                                        <ul class="item_marks">
                                                            <li class="item_mark item_discount">-25%</li>
                                                            {{-- <li class="item_mark item_new">new</li> --}}
                                                        </ul>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Brands -->

                    <div class="brands">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="brands_slider_container">

                                        <!-- Brands Slider -->

                                        <div class="owl-carousel owl-theme brands_slider">

                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_1.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_2.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_3.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_4.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_5.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_6.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_7.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="owl-item">
                                                <div class="brands_item d-flex flex-column justify-content-center">
                                                    <img src="{{ asset('public/frontend') }}/images/brands_8.jpg" alt="">
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Brands Slider Navigation -->
                                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i>
                                        </div>
                                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter -->

                    <div class="newsletter">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div
                                        class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                                        <div class="newsletter_title_container">
                                            <div class="newsletter_icon"><img
                                                    src="{{ asset('public/frontend') }}/images/send.png" alt=""></div>
                                            <div class="newsletter_title">Sign up for Newsletter</div>
                                            <div class="newsletter_text">
                                                <p>...and receive %20 coupon for first shopping.</p>
                                            </div>
                                        </div>
                                        <div class="newsletter_content clearfix">
                                            <form action="#" class="newsletter_form">
                                                <input type="email" class="newsletter_input" required="required"
                                                    placeholder="Enter your email address">
                                                <button class="newsletter_button">Subscribe</button>
                                            </form>
                                            <div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endsection

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="OneTech shop project">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.css">
    <link href="{{ asset('public/frontend') }}/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css" rel="stylesheet"
        type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/animate.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/main_styles.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/responsive.css">
    <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/toastr/toastr.min.css">
    @stack('front_css')
</head>

<body>

    <div class="super_container">

        <!-- Header -->

        <header class="header">

            <!-- Top Bar -->

            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/phone.png"
                                        alt=""></div>{{ $setting->phone_one }}
                            </div>
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('public/frontend') }}/images/mail.png"
                                        alt=""></div><a
                                    href="mailto:{{ $setting->main_email }}">{{ $setting->main_email }}</a>
                            </div>
                            <div class="top_bar_content ml-auto">
                                <div class="top_bar_menu">
                                    @if (Auth::check())
                                        <ul class="standard_dropdown top_bar_dropdown">
                                            <li>
                                                <a href="#">English<i class="fas fa-chevron-down"></i></a>
                                                <ul>
                                                    <li><a href="#">English</a></li>
                                                    <li><a href="#">Bangla</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">Currency<i class="fas fa-chevron-down"></i></a>
                                                <ul>
                                                    <li><a href="#">Taka ৳</a></li>
                                                    <li><a href="#">Dollar $</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    @endif
                                </div>
                                <div class="top_bar_user">
                                    @guest
                                        <div class="user_icon"><img src="{{ asset('public/frontend') }}/images/user.svg"
                                                alt=""></div>
                                        <div><a href="{{ route('register') }}">Register</a></div>
                                        <div><a href="{{ route('login') }}">Sign in</a></div>
                                    @else
                                        <ul class="standard_dropdown top_bar_dropdown">
                                            <li>
                                                <a href="#">
                                                    <div class="user_icon">
                                                        <img src="{{ asset('public/frontend') }}/images/user.svg"
                                                            alt="">
                                                    </div>
                                                    {{ Auth::user()->name }}
                                                </a>
                                                <ul>
                                                    <li><a href="{{ route('home') }}">Profile</a></li>
                                                    <li><a href="#">Order List</a></li>
                                                    <li><a href="#">Setting</a></li>
                                                    <li><a href="{{ route('customer.logout') }}">Logout</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Main -->

            <div class="header_main">
                <div class="container">
                    <div class="row">

                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo"><a href="{{ url('/') }}">{{ config('app.name') }}</a></div>
                            </div>
                        </div>

                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="#" class="header_search_form clearfix">
                                            <input type="search" required="required" class="header_search_input"
                                                placeholder="Search for products...">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc">All Categories</span>
                                                    <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        <li><a class="clc" href="#">All Categories</a></li>
                                                        <li><a class="clc" href="#">Computers</a></li>
                                                        <li><a class="clc" href="#">Laptops</a></li>
                                                        <li><a class="clc" href="#">Cameras</a></li>
                                                        <li><a class="clc" href="#">Hardware</a></li>
                                                        <li><a class="clc" href="#">Smartphones</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <button type="submit" class="header_search_button trans_300"
                                                value="Submit"><img
                                                    src="{{ asset('public/frontend') }}/images/search.png"
                                                    alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    <div class="wishlist_icon"><img
                                            src="{{ asset('public/frontend') }}/images/heart.png" alt="">
                                    </div>
                                    <div class="wishlist_content">
                                        <div class="wishlist_text"><a
                                                href="{{ route('wishlist.index') }}">Wishlist</a></div>
                                        <div class="wishlist_count">{{ $wishlist_count ?? 0 }}</div>
                                    </div>
                                </div>

                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        <div class="cart_icon">
                                            <img src="{{ asset('public/frontend') }}/images/cart.png" alt="">
                                            <div class="cart_count"><span id="cart_qty"></span>
                                            </div>
                                        </div>
                                        <div class="cart_content">
                                            <div class="cart_text"><a href="{{ route('cart.index') }}">Cart</a></div>
                                            <div class="cart_price">{{ $setting->currency }}
                                                <span id="cart_total"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @yield('navbar')
        </header>

        @yield('content')
        <!-- Footer -->

        <footer class="footer">
            @php
                $page_1 = DB::table('pages')
                    ->where('page_position', 1)
                    ->get();

                $page_2 = DB::table('pages')
                    ->where('page_position', 2)
                    ->get();
            @endphp
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 footer_col">
                        <div class="footer_column footer_contact">
                            <div class="logo_container">
                                <div class="logo"><a href="#">{{ config('app.name') }}</a></div>
                            </div>
                            <div class="footer_title">Got Question? Call Us 24/7</div>
                            <div class="footer_phone">{{ $setting->phone_one }}</div>
                            <div class="footer_contact_text">
                                <p>17 Princess Road, London</p>
                                <p>Grester London NW18JR, UK</p>
                            </div>
                            <div class="footer_social">
                                <ul>
                                    <li><a href="{{ $setting->facebook }}" target="_blank"><i
                                                class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="{{ $setting->twitter }}" target="_blank"><i
                                                class="fab fa-twitter"></i></a></li>
                                    <li><a href="{{ $setting->youtube }}" target="_blank"><i
                                                class="fab fa-youtube"></i></a></li>
                                    <li><a href="{{ $setting->instagram }}" target="_blank"><i
                                                class="fab fa-instagram"></i></a></li>
                                    <li><a href="{{ $setting->linkedin }}" target="_blank"><i
                                                class="fab fa-linkedin"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-2 offset-lg-2">
                        <div class="footer_column">
                            <div class="footer_title">Find it Fast</div>
                            <ul class="footer_list">
                                @foreach ($page_1 as $row)
                                    <li><a href="{{ route('page.view', $row->page_slug) }}">{{ $row->page_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="footer_column">
                            <ul class="footer_list footer_list_2">
                                @foreach ($page_2 as $row)
                                    <li><a href="{{ route('page.view', $row->page_slug) }}">{{ $row->page_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-2">
                        <div class="footer_column">
                            <div class="footer_title">Customer Care</div>
                            <ul class="footer_list">
                                <li><a href="{{ route('home') }}">My Account</a></li>
                                <li><a href="{{ route('order.tracking') }}">Order Tracking</a></li>
                                <li><a href="{{ route('wishlist.index') }}">Wish List</a></li>
                                <li><a href="{{ route('our.blog') }}">Our Blog</a></li>
                                <li><a href="{{ route('contact.us') }}">Contact Us</a></li>
                                {{-- <li><a href="#">Become a vendor</a></li> --}}
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </footer>

        <!-- Copyright -->

        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div
                            class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                            <div class="copyright_content">
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved | This template is made with <i
                                    class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                    target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </div>
                            <div class="logos ml-sm-auto">
                                <ul class="logos_list">
                                    <li><a href="#"><img
                                                src="{{ asset('public/frontend') }}/images/logos_1.png"
                                                alt=""></a></li>
                                    <li><a href="#"><img
                                                src="{{ asset('public/frontend') }}/images/logos_2.png"
                                                alt=""></a></li>
                                    <li><a href="#"><img
                                                src="{{ asset('public/frontend') }}/images/logos_3.png"
                                                alt=""></a></li>
                                    <li><a href="#"><img
                                                src="{{ asset('public/frontend') }}/images/logos_4.png"
                                                alt=""></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('public/frontend') }}/js/jquery-3.3.1.min.js"></script>
    <script src="{{ asset('public/frontend') }}/styles/bootstrap4/popper.js"></script>
    <script src="{{ asset('public/frontend') }}/styles/bootstrap4/bootstrap.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/TweenMax.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/TimelineMax.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/scrollmagic/ScrollMagic.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/animation.gsap.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/greensock/ScrollToPlugin.min.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/slick-1.8.0/slick.js"></script>
    <script src="{{ asset('public/frontend') }}/plugins/easing/easing.js"></script>
    <script src="{{ asset('public/frontend') }}/js/custom.js"></script>
    <script src="{{ asset('public/backend') }}/plugins/toastr/toastr.min.js"></script>
    @stack('front_script')
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert_type', 'info') }}";
            switch (type) {
                case 'info':
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
    <script>
        function cart() {
            $.ajax({
                url: "{{ route('cart.all') }}",
                type: "GET",
                async: false,
                success: function(data) {
                    $("#cart_qty").empty();
                    $("#cart_total").empty();
                    $("#cart_qty").append(data.cart_qty);
                    $("#cart_total").append(data.cart_total);
                }
            })
        }
        $(function() {
            cart();
        })
    </script>
</body>

</html>

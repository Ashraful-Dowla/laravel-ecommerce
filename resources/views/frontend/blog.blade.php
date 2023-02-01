@extends('layouts.app')

@section('navbar')
    @push('front_css')
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/blog_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/blog_responsive.css">
    @endpush
    @include('layouts.partial.front.collapse_navbar')
    @push('front_script')
        <script src="{{ asset('public/frontend') }}/js/product_custom.js"></script>
    @endpush
@endsection

@section('content')
    <!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll"
            data-image-src="{{ asset('public/frontend') }}/images/shop_background.jpg">
        </div>
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">Our blog</h2>
        </div>
    </div>

    <!-- Blog -->

    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog_posts d-flex flex-row align-items-start justify-content-between">

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_1.jpg)"></div>
                            <div class="blog_text">Vivamus sed nunc in arcu cursus mollis quis et orci. Interdum et
                                malesuada.</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_2.jpg)"></div>
                            <div class="blog_text">Cras lobortis nisl nec libero pulvinar lacinia. Nunc sed ullamcorper
                                massa.</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_3.jpg)"></div>
                            <div class="blog_text">Fusce tincidunt nulla magna, ac euismod quam viverra id. Fusce eget metus
                                feugiat</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_4.jpg)"></div>
                            <div class="blog_text">Etiam leo nibh, consectetur nec orci et, tempus tempus ex</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_5.jpg)"></div>
                            <div class="blog_text">Sed viverra pellentesque dictum. Aenean ligula justo, viverra in lacus
                                porttitor</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_6.jpg)"></div>
                            <div class="blog_text">In nisl tortor, tempus nec ex vitae, bibendum rutrum mi. Integer tempus
                                nisi</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_7.jpg)"></div>
                            <div class="blog_text">Make Life Easier on Yourself by Accepting “Good Enough.” Don’t Pursue
                                Perfection.</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_8.jpg)"></div>
                            <div class="blog_text">13 Reasons You Are Failing At Life And Becoming A Bum</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                        <!-- Blog post -->
                        <div class="blog_post">
                            <div class="blog_image"
                                style="background-image:url({{ asset('public/frontend') }}/images/blog_9.jpg)"></div>
                            <div class="blog_text">4 Steps to Getting Anything You Want In Life</div>
                            <div class="blog_button"><a href="blog_single.html">Continue Reading</a></div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Newsletter -->

    {{-- <div class="newsletter">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div
                        class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                        <div class="newsletter_title_container">
                            <div class="newsletter_icon"><img src="images/send.png" alt=""></div>
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
    </div> --}}
    @push('front_script')
        <script src="{{ asset('public/frontend') }}/plugins/parallax-js-master/parallax.min.js"></script>
        <script src="{{ asset('public/frontend') }}/js/blog_custom.js"></script>
    @endpush
@endsection

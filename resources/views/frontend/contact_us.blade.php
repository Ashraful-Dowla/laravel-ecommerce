@extends('layouts.app')

@section('navbar')
    @push('front_css')
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
    @endpush
    @include('layouts.partial.front.collapse_navbar')
    @push('front_script')
        <script src="{{ asset('public/frontend') }}/js/product_custom.js"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/contact_styles.css">
        <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/contact_responsive.css">
    @endpush
@endsection

@section('content')
    <!-- Contact Info -->

    <div class="contact_info">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div
                        class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="images/contact_1.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Phone</div>
                                <div class="contact_info_text">{{ $setting->phone_one }}</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="images/contact_2.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Email</div>
                                <div class="contact_info_text">{{ $setting->support_email }}</div>
                            </div>
                        </div>

                        <!-- Contact Item -->
                        <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                            <div class="contact_info_image"><img src="images/contact_3.png" alt=""></div>
                            <div class="contact_info_content">
                                <div class="contact_info_title">Address</div>
                                <div class="contact_info_text">10 Suffolk at Soho, London, UK</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form -->

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="contact_form_container">
                        <div class="contact_form_title">Get in Touch</div>
                        <form action="{{ route('contact.us.store') }}">
                            <div
                                class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                                @csrf
                                <input type="text" id="contact_form_name" class="contact_form_name input_field"
                                    placeholder="Your name" required name="name">
                                <input type="email" id="contact_form_email" class="contact_form_email input_field"
                                    placeholder="Your email" required name="email">
                                <input type="text" id="contact_form_phone" class="contact_form_phone input_field"
                                    placeholder="Your phone number" required name="phone">
                            </div>
                            <div class="contact_form_text">
                                <textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4"
                                    placeholder="Message" required name="message"></textarea>
                            </div>
                            <div class="contact_form_button">
                                <button type="submit" class="button contact_submit_button">Send Message</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div class="panel"></div>
    </div>

    <!-- Map -->

    <div class="contact_map">
        <div id="google_map" class="google_map">
            <div class="map_container">
                <div id="map"></div>
            </div>
        </div>
    </div>
    @push('front_script')
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
        <script src="{{ asset('public/frontend') }}/js/contact_custom.js"></script>
    @endpush
@endsection

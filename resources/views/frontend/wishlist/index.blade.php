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
                <div class="col-lg-10 offset-lg-1">
                    <div class="cart_container">
                        <div class="cart_title">Your Wishlist Cart</div>
                        <div class="cart_items">
                            @forelse ($wishlist as $row)
                                <ul class="cart_list">
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img
                                                src="{{ asset($row->product->product_thumbnail) }}" alt="">
                                        </div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ substr($row->product->product_name, 0, 20) }}
                                                </div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Date</div>
                                                <div class="cart_item_text">
                                                    {{ $row->date }}
                                                </div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Add</div>
                                                <div class="cart_item_text">
                                                    <a href="{{ route('product.details', $row->product->product_slug) }}"
                                                        class="button cart_button_clear text-danger"><i
                                                            class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Remove</div>
                                                <div class="cart_item_text">
                                                    <a href="{{ route('wishlist.destroy.id', $row->id) }}"
                                                        class="button cart_button_clear text-danger"><i
                                                            class="fa fa-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @empty
                                <p class="h2 text-center">Your Wishlist is Empty</p>
                            @endforelse
                        </div>
                        <!-- Order Total -->
                        @if (count($wishlist) != 0)
                            <div class="cart_buttons">
                                <a href="{{ url('/') }}" class="button cart_button_clear text-danger">
                                    Back Home
                                </a>
                                <a href="{{ route('wishlist.destroy') }}" class="button cart_button_clear text-danger">
                                    Wishlist Empty
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('front_script')
    <script src="{{ asset('public/frontend') }}/js/cart_custom.js"></script>
@endpush

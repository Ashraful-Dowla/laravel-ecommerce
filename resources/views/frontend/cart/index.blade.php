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
                        <div class="cart_title">Shopping Cart</div>
                        <div class="cart_items">
                            @forelse ($cart_content as $row)
                                @php
                                    $product = \App\Models\Product::where('id', $row->id)->first();
                                    $colors = explode(',', $product->product_color);
                                    $sizes = explode(',', $product->product_size);
                                @endphp
                                <ul class="cart_list">
                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img src="{{ asset($row->options->thumbnail) }}"
                                                alt="">
                                        </div>
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ substr($row->name, 0, 10) }}</div>
                                            </div>
                                            @if ($row->options->color)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Color</div>
                                                    <div class="cart_item_text">
                                                        <select name="color" class="form-control"
                                                            style="min-width: 100px;"
                                                            onchange="cartProductUpdate(`{{ $row->rowId }}`)"
                                                            id="color_{{ $row->rowId }}">
                                                            @foreach ($colors as $color)
                                                                <option value="{{ $color }}"
                                                                    {{ $row->options->color == $color ? 'selected' : null }}>
                                                                    {{ $color }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($row->options->size)
                                                <div class="cart_item_color cart_info_col">
                                                    <div class="cart_item_title">Size</div>
                                                    <div class="cart_item_text">
                                                        <select name="color" class="form-control"
                                                            style="min-width: 100px;"
                                                            onchange="cartProductUpdate(`{{ $row->rowId }}`)"
                                                            id="size_{{ $row->rowId }}">
                                                            @foreach ($sizes as $size)
                                                                <option value="{{ $size }}"
                                                                    {{ $row->options->size == $size ? 'selected' : null }}>
                                                                    {{ $size }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <div class="cart_item_text">
                                                    <input type="number" class="form-control" name="qty" min="1"
                                                        id="qty_{{ $row->rowId }}" style="width: 50px;"
                                                        value="{{ $row->qty }}"
                                                        max="{{ $product->product_stock_quantity }}"
                                                        onblur="cartProductUpdate(`{{ $row->rowId }}`)">
                                                </div>
                                            </div>
                                            <div class="cart_item_price cart_info_col">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">{{ $setting->currency }}{{ $row->price }} x
                                                    {{ $row->qty }}
                                                </div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">
                                                    {{ $setting->currency }}{{ $row->price * $row->qty }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col">
                                                <div class="cart_item_title">Action</div>
                                                <div class="cart_item_text">
                                                    <a href="#" onclick="removeProductById(`{{ $row->rowId }}`)">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            @empty
                                <p class="h2 text-center">Your Cart is Empty</p>
                            @endforelse
                        </div>
                        <!-- Order Total -->
                        @if (count($cart_content) != 0)
                            <div class="order_total">
                                <div class="order_total_content text-md-right">
                                    <div class="order_total_title">Order Total:</div>
                                    <div class="order_total_amount"> {{ $setting->currency }}{{ Cart::total() }}
                                    </div>
                                </div>
                            </div>

                            <div class="cart_buttons">
                                <a href="{{ route('cart.destroy') }}" class="button cart_button_clear text-danger">Cart
                                    Empty</a>
                                <a href="{{ route('checkout.index') }}" class="button cart_button_checkout">Checkout</a>
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

        function cartProductUpdate(rowId) {
            let url = "{{ route('cart.product.update', ':id') }}";
            url = url.replace(':id', rowId);

            let qty = $("#qty_" + rowId).val();
            let color = $("#color_" + rowId).val();
            let size = $("#size_" + rowId).val();

            $.ajax({
                type: "POST",
                async: false,
                url: url,
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    qty,
                    color,
                    size
                },
                success: function(data) {
                    toastr.success(data);
                    window.location.reload();
                }
            })
        }
    </script>
@endpush

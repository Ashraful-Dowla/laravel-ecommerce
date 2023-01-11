@php
    $colors = explode(',', $product->product_color);
    $sizes = explode(',', $product->product_size);
@endphp
<div class="modal-body product_view">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
                <div class="">
                    <img src="{{ asset($product->product_thumbnail) }}" height="100%" width="100%">
                </div>
            </div>
            <div class="col-lg-8 ">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->category->category_name }} > {{ $product->subcategory->subcategory_name }}</p>
                <p>Brand: {{ $product->brand == null ? 'Unknown' : $product->brand->brand_name }}</p>
                <p>Stock: @if ($product->product_stock_quantity < 1)
                        <span class="badge badge-danger">Stock Out</span>
                    @else
                        <span class="badge badge-success">Stock Available</span>
                    @endif
                </p>
                <div>
                    @if ($product->product_discount_price == null)
                        <div class="">Price: {{ $setting->currency }}{{ $product->product_selling_price }}</div>
                    @else
                        <div class="">
                            Price: <del
                                class="text-danger">{{ $setting->currency }}{{ $product->product_selling_price }}</del
                                class="text-danger">
                            {{ $setting->currency }}{{ $product->product_discount_price }}</div>
                    @endif
                </div>
                <div class="order_info d-flex flex-row">
                    <form action="#" method="post" id="add_cart_form">
                        @csrf
                        {{-- cart add details --}}
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="form-group">
                            <div class="row">
                                @isset($product->product_size)
                                    <div class="col-lg-4">
                                        <label>Size: </label>
                                        <select class="custom-select form-control-sm" name="size"
                                            style="min-width: 120px; margin-left: -4px;">
                                            @foreach ($sizes as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endisset
                                @isset($product->product_color)
                                    <div class="col-lg-4">
                                        <label>Color: </label>
                                        <select class="custom-select form-control-sm" name="color"
                                            style="min-width: 120px;">
                                            @foreach ($colors as $color)
                                                <option value="{{ $color }}">{{ $color }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endisset

                            </div>
                            <div class="col-lg-4" style="margin-left: -5px;">
                                <label>Quantity: </label>
                                <input type="number" min="1" max="100" name="qty"
                                    class="form-control-sm" value="1" style="min-width: 120px; margin-left: -4px;">
                            </div>
                        </div>
                        <div class="button_container">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    @if ($product->product_stock_quantity < 1)
                                        <span class="text-danger">Stock Out</span>
                                    @else
                                        <button class="btn btn-sm btn-outline-info" type="submit"
                                            style="float: right;">
                                            <span class="loading d-none">....</span> Add to cart</button>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

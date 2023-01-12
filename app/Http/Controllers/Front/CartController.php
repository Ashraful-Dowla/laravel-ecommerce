<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // product add to cart
    public function add_to_cart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        $price = $product->product_discount_price == null ? $product->product_selling_price : $product->product_discount_price;

        Cart::add([
            'id' => $product->id,
            'name' => $product->product_name,
            'qty' => $request->qty,
            'price' => $price,
            'weight' => '1',
            'options' => [
                'size' => $request->size,
                'color' => $request->color,
                'thumbnail' => $product->product_thumbnail,
            ],
        ]);

        return response()->json("Product added to cart");
    }

    //get all cart
    public function all_cart()
    {
        return response()->json([
            'cart_qty' => Cart::count(),
            'cart_total' => Cart::total(),
        ]);
    }
}

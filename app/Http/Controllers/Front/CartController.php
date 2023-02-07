<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CampaignProduct;
use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // show cart page
    public function index()
    {
        $cart_content = Cart::content();
        return view('frontend.cart.index', compact('cart_content'));
    }

    // product add to cart
    public function add_to_cart(Request $request)
    {
        $product = Product::where('id', $request->id)->first();

        $price = $product->product_discount_price == null ? $product->product_selling_price : $product->product_discount_price;

        if ($request->has('campaign_id')) {
            $campaign_product = CampaignProduct::where('campaign_id', $request->campaign_id)
                ->where('product_id', $product->id)
                ->first();

            $price = $campaign_product->price;
        }

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

    //product remove from cart
    public function remove($rowId)
    {
        Cart::remove($rowId);
        return response()->json("Cart Item removed");
    }

    //product cart update
    public function update(Request $request, $rowId)
    {
        $thumbnail = Cart::get($rowId)->options->thumbnail;

        Cart::update($rowId, [
            'qty' => $request->qty,
            'options' => [
                'color' => $request->color,
                'size' => $request->size,
                'thumbnail' => $thumbnail,
            ],
        ]);

        return response()->json('Cart Item updated');
    }

    //cart destroy
    public function destroy()
    {
        Cart::destroy();
        $notification = array('message' => 'Cart Item cleared', 'alert_type' => 'success');
        return back()->with($notification);
    }

}

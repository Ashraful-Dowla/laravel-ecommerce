<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Auth;
use Cart;
use DB;
use Illuminate\Http\Request;
use Session;

class CheckoutController extends Controller
{
    //cart checkout
    public function index()
    {
        if (!Auth::check()) {
            session(['prev_links' => 'checkout.index']);

            return redirect()->route('login');
        }

        // Session::forget('coupon');
        $cart_content = Cart::content();
        return view('frontend.cart.checkout', compact('cart_content'));
    }

    //coupoun apply
    public function coupon_apply(Request $request)
    {
        $check = DB::table('coupons')->where('coupon_code', $request->coupoun_code)->first();

        if (!$check) {
            $notification = array('message' => 'Invalid Coupon Code', 'alert_type' => 'error');
            return back()->with($notification);
        }

        if (date('Y-m-d', strtotime(date('Y-m-d'))) > date($check->coupon_valid_date, strtotime(date('Y-m-d')))) {
            $notification = array('message' => 'Expired Coupon Code', 'alert_type' => 'error');
            return back()->with($notification);
        }

        $subtotal = str_replace(',', '', Cart::subtotal());
        $after_discount = $subtotal < $check->coupon_amount ? 0 : $subtotal - $check->coupon_amount;
        Session::put('coupon', [
            'code' => $check->coupon_code,
            'discount' => $check->coupon_amount,
            'after_discount' => $after_discount,
        ]);

        $notification = array('message' => 'Coupon Applied', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //coupon remove
    public function coupon_remove()
    {
        Session::forget('coupon');

        $notification = array('message' => 'Coupon Removed', 'alert_type' => 'success');
        return back()->with($notification);
    }

    public function order_place(Request $request)
    {
        if (Cart::count() == 0) {
            return response()->json(['message' => 'Cart is Empty'], 400);
        }

        $request->validate([
            'c_name' => 'required',
            'c_email' => 'required|email',
            'c_country' => 'required',
            'c_phone' => 'required',
            'c_city' => 'required',
            'c_zipcode' => 'required',
            'c_address' => 'required',
            'payment_type' => 'required',
        ]);

        $order_data = [
            'user_id' => Auth::id(),
            'c_name' => $request->c_name,
            'c_email' => $request->c_email,
            'c_country' => $request->c_country,
            'c_phone' => $request->c_phone,
            'c_phone_2' => $request->c_phone_2,
            'c_city' => $request->c_city,
            'c_zipcode' => $request->c_zipcode,
            'c_address' => $request->c_address,
            'c_address_2' => $request->c_address_2,
            'payment_type' => $request->payment_type,
            'total' => Cart::total(),
            'subtotal' => Cart::subtotal(),
            'after_discount' => Cart::total(),
            'tax' => 0,
            'shipping_charge' => 0,
            'order_id' => mt_rand(1000000000, 9999999999),
            'date' => date('d-m-Y'),
            'month' => date('F'),
            'year' => date('Y'),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (Session::has('coupon')) {
            $order_data['coupon_code'] = Session::get('coupon')['code'];
            $order_data['coupon_discount'] = Session::get('coupon')['discount'];
            $order_data['after_discount'] = Session::get('coupon')['after_discount'];
        }

        $order_id = DB::table('orders')->insertGetId($order_data);

        //order details

        $cart_content = Cart::content();
        foreach ($cart_content as $row) {
            DB::table('order_details')->insert([
                'order_id' => $order_id,
                'product_id' => $row->id,
                'product_name' => $row->name,
                'product_color' => $row->options->color,
                'product_size' => $row->options->size,
                'product_quantity' => $row->qty,
                'product_price' => $row->price,
                'subtotal' => $row->qty * $row->price,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        Cart::destroy();

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        return response()->json('Order Placed');
    }
}

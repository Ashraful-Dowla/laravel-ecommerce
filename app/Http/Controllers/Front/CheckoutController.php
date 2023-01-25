<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use Auth;
use Cart;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            $notification = array('message' => 'Cart is Empty', 'alert_type' => 'error');
            return back()->with($notification);
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

        if ($request->payment_type == "Aamarpay") {
            $aamar_pay = DB::table('payment_gateway_bd')->where('gateway_name', 'Aamarpay')->first();

            if ($aamar_pay->store_id == null) {
                $notification = array('message' => 'Payment Service is currently unavailable', 'alert_type' => 'error');
                return back()->with($notification);
            }

            $url = null;
            if ($aamar_pay->status == 1) {
                $url = 'https://secure.aamarpay.com/request.php';
            } else {
                $url = 'https://sandbox.aamarpay.com/request.php';
            }

            //$url = 'https://sandbox.aamarpay.com/request.php'; // live url https://secure.aamarpay.com/request.php
            $fields = array(
                'store_id' => $aamar_pay->store_id, //store id will be aamarpay,  contact integration@aamarpay.com for test/live id
                'amount' => str_replace(',', '', Cart::total()), //transaction amount
                'payment_type' => 'VISA', //no need to change
                'currency' => 'BDT', //currenct will be USD/BDT
                'tran_id' => rand(1111111, 9999999), //transaction id must be unique from your end
                'cus_name' => $request->c_name, //customer name
                'cus_email' => $request->c_email, //customer email address
                'cus_add1' => $request->c_address, //customer address
                'cus_add2' => $request->c_address_2, //customer address
                'cus_city' => $request->c_city, //customer city
                'cus_state' => $request->c_city, //state
                'cus_postcode' => $request->c_zipcode, //postcode or zipcode
                'cus_country' => $request->c_country, //country
                'cus_phone' => $request->c_phone, //customer phone number
                'cus_fax' => 'Not¬Applicable', //fax
                'ship_name' => 'ship name', //ship name
                'ship_add1' => 'House B-121, Road 21', //ship address
                'ship_add2' => 'Mohakhali',
                'ship_city' => 'Dhaka',
                'ship_state' => 'Dhaka',
                'ship_postcode' => '1212',
                'ship_country' => 'Bangladesh',
                'desc' => 'payment description',
                'success_url' => route('success'), //your success route
                'fail_url' => route('fail'), //your fail route
                'cancel_url' => route('cancel', $order_id), //your cancel url
                'opt_a' => 'sdasd', //optional paramter
                'opt_b' => 'dsadsa',
                'opt_c' => 'sdasd',
                'opt_d' => $order_id,
                'signature_key' => $aamar_pay->signature_key,
            ); //signature key will provided aamarpay, contact integration@aamarpay.com for test/live signature key

            $fields_string = http_build_query($fields);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_VERBOSE, true);
            curl_setopt($ch, CURLOPT_URL, $url);

            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));
            curl_close($ch);

            $this->redirect_to_merchant($url_forward);
        }

        Mail::to($request->c_email)->send(new InvoiceMail($order_data));
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

        $notification = array('message' => 'Order Placed', 'alert_type' => 'success');
        return back()->with($notification);

    }

    public function redirect_to_merchant($url)
    {

        ?>
        <html xmlns="http://www.w3.org/1999/xhtml">
          <head><script type="text/javascript">
            function closethisasap() { document.forms["redirectpost"].submit(); }
          </script></head>
          <body onLoad="closethisasap();">

            <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/' . $url; ?>"></form>
            <!-- for live url https://secure.aamarpay.com -->
          </body>
        </html>
        <?php
exit;
    }

    //payment gateway
    public function success(Request $request)
    {
        $order_id = $request->opt_d;
        $order_data = DB::table('orders')->where('id', $order_id)->first();

        $order_data = (array) $order_data;

        Mail::to($order_data['c_email'])->send(new InvoiceMail($order_data));

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

        $order_data = DB::table('orders')->where('id', $order_id)->update([
            'status' => 1,
        ]);

        Cart::destroy();

        if (Session::has('coupon')) {
            Session::forget('coupon');
        }

        $notification = array('message' => 'Order Succesfully Placed', 'alert_type' => 'success');
        return redirect()->route('home')->with($notification);

    }

    //payment gateway
    public function fail(Request $request)
    {
        $order = DB::table('orders')->where('id', $request->opt_d)->first();

        if ($order->coupon_code) {
            Session::put('coupon', [
                'code' => $order->coupon_code,
                'discount' => $order->coupon_discount,
                'after_discount' => $order->after_discount,
            ]);
        }

        $order = DB::table('orders')->where('id', $request->opt_d)->delete();

        $notification = array('message' => 'Payment Failed', 'alert_type' => 'error');
        return redirect()->route('checkout.index')->with($notification);
    }

    public function cancel($id)
    {
        $query = DB::table('order_details')->where('order_id', $id)->first();

        if (!$query) {
            DB::table('orders')->where('id', $id)->delete();
        }

        return redirect()->to('/');
    }
}

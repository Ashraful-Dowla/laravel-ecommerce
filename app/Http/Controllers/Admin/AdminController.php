<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\Ticket;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //admin dashboard
    public function admin()
    {
        $customers = User::where('is_admin', '!=', 1)
            ->orWhere('is_admin', null)
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        $orders = Order::orderBy('id', 'desc')
            ->limit(8)
            ->get();

        $products = Product::where('product_status', 1)
            ->orderBy('product_views', 'desc')
            ->limit(8)
            ->get();

        $total_product = Product::count();
        $active_product = Product::where('product_status', 1)->count();
        $inactive_product = Product::where('product_status', 0)->count();

        $all_customers = User::where('is_admin', '!=', 1)
            ->orWhere('is_admin', null)
            ->count();

        $category = Category::count();
        $brand = Brand::count();
        $ticket = Ticket::where('status', 0)->count();
        $review = Review::count();

        $coupon = DB::table('coupons')->count();
        $subscriber = DB::table('newsletters')->count();
        $pending_order = Order::where('status', 0)->count();
        $success_order = Order::where('status', 3)->count();

        // return response()->json($total_products);
        return view('admin.home', compact('customers', 'orders', 'products', 'total_product', 'active_product',
            'inactive_product', 'all_customers', 'category', 'brand', 'ticket', 'review',
            'coupon', 'subscriber', 'pending_order', 'success_order'));
    }

    //admin password change
    public function passwordChange()
    {
        return view('admin.profile.password_change');
    }

    //admin password update
    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            Auth::logout();
            $notification = array('message' => 'Password changed', 'alert_type' => 'success');
            return redirect()->route('admin.login')->with($notification);
        } else {
            $notification = array('message' => 'Current Password does not match', 'alert_type' => 'error');
            return back()->with($notification);
        }

    }

    //admin custom logout
    public function logout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out', 'alert_type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
}

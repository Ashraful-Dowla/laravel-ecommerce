<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Auth;

class WishlistController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    // show wishlist page
    public function index()
    {
        if (!Auth::check()) {
            $notification = array('message' => 'Please login for wishlist', 'alert_type' => 'error');
            return back()->with($notification);
        }

        $wishlist = Wishlist::where('user_id', Auth::id())->get();

        return view('frontend.wishlist.index', compact('wishlist'));
    }

    //store wishlist
    public function store($id)
    {
        if (!Auth::check()) {
            $notification = array('message' => 'Please login for wishlist', 'alert_type' => 'error');
            return back()->with($notification);
        }

        $check_wishlist = Wishlist::where('product_id', $id)->where('user_id', Auth::id())->first();
        if ($check_wishlist) {
            $notification = array('message' => 'Product is already wishlisted!', 'alert_type' => 'error');
            return back()->with($notification);
        }

        Wishlist::insert([
            'user_id' => Auth::id(),
            'product_id' => $id,
            'date' => date('d, F Y'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Product added on wishlist!', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //wishlist delete
    public function destroy()
    {
        if (!Auth::check()) {
            $notification = array('message' => 'Please login for wishlist', 'alert_type' => 'error');
            return back()->with($notification);
        }

        Wishlist::where('user_id', Auth::id())->delete();
        $notification = array('message' => 'Wishlist cleared!', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //wishlist delete by id
    public function destroy_by_id($id)
    {
        if (!Auth::check()) {
            $notification = array('message' => 'Please login for wishlist', 'alert_type' => 'error');
            return back()->with($notification);
        }

        Wishlist::where('id', $id)->delete();
        $notification = array('message' => 'Wishlist item deleted!', 'alert_type' => 'success');
        return back()->with($notification);
    }
}

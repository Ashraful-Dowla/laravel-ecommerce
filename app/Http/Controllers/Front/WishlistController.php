<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Auth;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store($id)
    {
        $check_wishlist = Wishlist::where('product_id', $id)->where('user_id', Auth::id())->first();
        if ($check_wishlist) {
            $notification = array('message' => 'Product is already wishlisted!', 'alert_type' => 'error');
            return back()->with($notification);
        }

        Wishlist::insert([
            'user_id' => Auth::id(),
            'product_id' => $id,
        ]);

        $notification = array('message' => 'Product added on wishlist!', 'alert_type' => 'success');
        return back()->with($notification);
    }
}

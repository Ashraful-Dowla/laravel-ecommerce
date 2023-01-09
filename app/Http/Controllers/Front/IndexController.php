<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Wishlist;
use Auth;

class IndexController extends Controller
{
    //root page
    public function index()
    {
        $categories = Category::all();
        $banner_product = Product::where('product_slider', 1)->latest()->first();
        return view('frontend.index', compact('categories', 'banner_product'));
    }

    // single product view
    public function product_details($slug)
    {
        $product = Product::where('product_slug', $slug)->first();
        $related_products = Product::where('subcategory_id', $product->subcategory_id)->orderBy('id', 'desc')->take(10)->get();
        $reviews = Review::where('product_id', $product->id)->orderBy('id', 'desc')->take(6)->get();
        $wishlist_count = Wishlist::where('user_id', Auth::id())->count();
        return view('frontend.product_details', compact('product', 'related_products', 'reviews', 'wishlist_count'));
    }
}

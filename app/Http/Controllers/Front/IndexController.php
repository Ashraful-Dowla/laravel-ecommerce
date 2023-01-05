<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class IndexController extends Controller
{
    //root page
    public function index()
    {
        $categories = Category::all();
        $banner_product = Product::where('product_slider',1)->latest()->first();
        return view('frontend.index', compact('categories','banner_product'));
    }

    // single product view
    public function product_details($slug)
    {
        $product = Product::where('product_slug',$slug)->first();
        return view('frontend.product_details', compact('product'));
    }
}

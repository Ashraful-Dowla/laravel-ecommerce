<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Childcategory;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;
use App\Models\Wishlist;
use Auth;
use DB;

class IndexController extends Controller
{
    //root page
    public function index()
    {
        $categories = Category::all();
        $banner_product = Product::where('product_status', 1)->where('product_slider', 1)->latest()->first();
        $featured_products = Product::where('product_status', 1)->where('product_featured', 1)->orderBy('id')->limit(16)->get();
        $popular_products = Product::where('product_status', 1)->orderBy('product_views', 'desc')->limit(8)->get();
        $trendy_products = Product::where('product_status', 1)->where('product_trendy', 1)->orderBy('id', 'desc')->get();
        $wishlist_count = Wishlist::where('user_id', Auth::id())->count();
        $brands = Brand::where('front_page', 1)->inRandomOrder()->limit(12)->get();
        $random_products = Product::where('product_status', 1)->inRandomOrder()->limit(16)->get();

        $home_category = Category::where('category_home_page', 1)->orderBy('category_name', 'asc')->get();

        $today_deal_products = Product::where('product_status', 1)->where('product_today_deal', 1)->orderBy('id')->limit(6)->get();

        $website_reviews = DB::table('website_reviews')->where('website_review_status', 1)->orderBy('id', 'desc')->limit(12)->get();

        return view('frontend.index', compact('categories', 'banner_product',
            'featured_products', 'wishlist_count', 'popular_products',
            'trendy_products', 'home_category', 'brands', 'random_products', 'today_deal_products', 'website_reviews'));
    }

    // single product view
    public function product_details($slug)
    {
        Product::where('product_slug', $slug)->increment('product_views');
        $product = Product::where('product_slug', $slug)->first();
        $related_products = Product::where('subcategory_id', $product->subcategory_id)->orderBy('id', 'desc')->take(10)->get();
        $reviews = Review::where('product_id', $product->id)->orderBy('id', 'desc')->take(6)->get();
        $wishlist_count = Wishlist::where('user_id', Auth::id())->count();

        return view('frontend.product.product_details', compact('product', 'related_products', 'reviews', 'wishlist_count'));
    }

    //product quick view
    public function product_quick_view($id)
    {
        $product = Product::where('id', $id)->first();
        return view('frontend.product.product_quick_view', compact('product'));
    }

    //categorywise product
    public function categoryWiseProduct($id)
    {
        $category = Category::where('id', $id)->first();
        $subcategories = Subcategory::where('category_id', $id)->get();
        $brands = Brand::all();
        $categorywise_products = Product::where('category_id', $id)->paginate(10);
        $random_products = Product::where('product_status', 1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.categorywise_products', compact('category', 'subcategories',
            'brands', 'categorywise_products', 'random_products'));
    }

    //subcategorywise product
    public function subcategoryWiseProduct($id)
    {
        $subcategory = Subcategory::where('id', $id)->first();
        $childcategories = Childcategory::where('subcategory_id', $id)->get();
        $brands = Brand::all();
        $categorywise_products = Product::where('subcategory_id', $id)->paginate(10);
        $random_products = Product::where('product_status', 1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.subcategorywise_products', compact('subcategory', 'childcategories',
            'brands', 'categorywise_products', 'random_products'));
    }

    //childcategorywise product
    public function childcategoryWiseProduct($id)
    {
        $childcategory = Childcategory::where('id', $id)->first();
        $categories = Category::all();
        $brands = Brand::all();
        $categorywise_products = Product::where('childcategory_id', $id)->paginate(10);
        $random_products = Product::where('product_status', 1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.childcategorywise_products', compact('childcategory', 'categories',
            'brands', 'categorywise_products', 'random_products'));
    }

    //brandwise product
    public function brandWiseProduct($id)
    {
        $brand = Brand::where('id', $id)->first();
        $categories = Category::all();
        $brands = Brand::all();
        $categorywise_products = Product::where('brand_id', $id)->paginate(10);
        $random_products = Product::where('product_status', 1)->inRandomOrder()->limit(16)->get();

        return view('frontend.product.brandwise_products', compact('brand', 'categories',
            'brands', 'categorywise_products', 'random_products'));
    }

    //page view
    public function pageView($slug)
    {
        $page = DB::table('pages')->where('page_slug', $slug)->first();
        return view('frontend.page', compact('page'));
    }
}

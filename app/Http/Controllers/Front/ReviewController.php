<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Auth;
use DB;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'review_description' => 'required',
            'review_rating' => 'required|in:1,2,3,4,5',
        ]);

        $review_check = Review::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($review_check) {
            $notification = array('message' => 'Already review submitted once!', 'alert_type' => 'error');
            return back()->with($notification);
        }

        Review::insert([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'review_description' => $request->review_description,
            'review_rating' => $request->review_rating,
            'review_date' => date('d-m-Y'),
            'review_month' => date('F'),
            'review_year' => date('Y'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Thanks for your review', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //website review
    public function website()
    {
        return view('user.review_website');
    }

    //websiter review store
    public function website_review_store(Request $request)
    {
        DB::table('website_reviews')->insert([
            'user_id' => Auth::id(),
            'user_name' => Auth::user()->name,
            'website_review_description' => $request->website_review_description,
            'website_review_rating' => $request->website_review_rating,
            'website_review_date' => date('d, F Y'),
            'website_review_status' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Thanks for your review', 'alert_type' => 'success');
        return back()->with($notification);
    }
}

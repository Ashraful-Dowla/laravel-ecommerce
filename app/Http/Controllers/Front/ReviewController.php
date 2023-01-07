<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Auth;
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
}

<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'is_not_admin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = DB::table('orders')->where('user_id', Auth::id())->orderBy('id', 'desc')->take(10)->get();

        $query = DB::table('orders')->where('user_id', Auth::id());
        $total_order = $query->count();
        $complete_order = $query->where('status', 3)->count();
        $cancel_order = $query->where('status', 5)->count();
        $return_order = $query->where('status', 4)->count();

        return view('home', compact('orders', 'total_order', 'complete_order', 'cancel_order', 'return_order'));
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }
}

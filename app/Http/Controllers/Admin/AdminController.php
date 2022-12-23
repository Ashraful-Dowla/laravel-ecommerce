<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //admin dashboard
    public function admin()
    {
        return view('admin.home');
    }

    //admin custom logout
    public function logout()
    {
        Auth::logout();
        $notification = array('message' => 'You are logged out', 'alert_type' => 'success');
        return redirect()->route('admin.login')->with($notification);
    }
}

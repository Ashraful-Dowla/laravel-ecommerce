<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
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
        return view('admin.home');
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

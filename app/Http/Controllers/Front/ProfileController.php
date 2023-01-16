<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('user.profile_setting');
    }

    public function password_change(Request $request)
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
            return redirect()->to('/')->with($notification);
        } else {
            $notification = array('message' => 'Current Password does not match', 'alert_type' => 'error');
            return back()->with($notification);
        }
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Http\Request;
use Image;

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

    public function my_order()
    {
        $orders = DB::table('orders')->where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->get();

        return view('user.my_order', compact('orders'));

    }

    public function ticket_open()
    {
        $tickets = DB::table('tickets')->where('user_id', Auth::id())->latest()->take(10)->get();
        return view('user.ticket', compact('tickets'));
    }

    public function ticket_new()
    {
        return view('user.ticket_new');
    }

    public function ticket_store(Request $request)
    {
        $request->validate([
            'subject' => 'required',
        ]);

        $photo_file_path = null;
        if ($request->has('image')) {
            $photo = $request->image;
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo_file_path = "public/files/ticket/" . $photoname;
            Image::make($photo)->resize(240, 120)->save($photo_file_path);
        }

        DB::table('tickets')->insert([
            'subject' => $request->subject,
            'priority' => $request->priority,
            'service' => $request->service,
            'message' => $request->message,
            'image' => $photo_file_path,
            'date' => date('Y-m-d'),
            'user_id' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Ticket Created', 'alert_type' => 'success');
        return back()->with($notification);
    }

    public function ticket_show($id)
    {
        $ticket = DB::table('tickets')->where('id', $id)->first();
        return view('user.ticket_show', compact('ticket'));
    }

    public function ticket_reply(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'image' => 'mimes:jpeg,jpg,png,gif|max:1000',
        ]);

        $photo_file_path = null;
        if ($request->has('image')) {
            $photo = $request->image;
            $photoname = uniqid() . '.' . $photo->getClientOriginalExtension();
            $photo_file_path = "public/files/ticket/" . $photoname;
            Image::make($photo)->resize(240, 120)->save($photo_file_path);
        }

        Reply::insert([
            'message' => $request->message,
            'image' => $photo_file_path,
            'user_id' => Auth::id(),
            'ticket_id' => $request->ticket_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Ticket Replied', 'alert_type' => 'success');
        return back()->with($notification);
    }

    public function my_order_view($id)
    {
        $order = DB::table('orders')->where('user_id', Auth::id())
            ->where('id', $id)
            ->first();

        $order_details = DB::table('order_details')->where('order_id', $order->id)->get();

        return view('user.order_details', compact('order', 'order_details'));
    }

}

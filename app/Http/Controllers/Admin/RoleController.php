<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //role list
    public function index()
    {
        $users = User::where('is_admin', 1)->where('role_admin', 1)->get();
        return view('admin.role.index', compact('users'));
    }

    //role create
    public function create()
    {
        return view('admin.role.create');
    }

    //role store
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => 1,
            'role_admin' => 1,
            'category' => $request->category,
            'product' => $request->product,
            'offer' => $request->offer,
            'order' => $request->order,
            'blog' => $request->blog,
            'pickup' => $request->pickup,
            'ticket' => $request->ticket,
            'contact' => $request->contact,
            'report' => $request->report,
            'setting' => $request->setting,
            'user_role' => $request->user_role,
        ]);

        $notification = array('message' => 'Role created', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //role edit
    public function edit($id)
    {
        $user = User::where('is_admin', 1)->where('role_admin', 1)->where('id', $id)->first();
        if (!$user) {
            $notification = array('message' => 'Role not found', 'alert_type' => 'error');
            return back()->with($notification);
        }
        return view('admin.role.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => 1,
            'role_admin' => 1,
            'category' => $request->category,
            'product' => $request->product,
            'offer' => $request->offer,
            'order' => $request->order,
            'blog' => $request->blog,
            'pickup' => $request->pickup,
            'ticket' => $request->ticket,
            'contact' => $request->contact,
            'report' => $request->report,
            'setting' => $request->setting,
            'user_role' => $request->user_role,
        ]);

        $notification = array('message' => 'Role updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //role delete
    public function destroy($id)
    {
        User::destroy($id);
        $notification = array('message' => 'Role Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }

}

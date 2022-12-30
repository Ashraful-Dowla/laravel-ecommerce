<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;
use View;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show coupon list
    public function index()
    {
        return view('admin.offer.coupon.index');
    }

    // coupon data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {
            $coupons = DB::table('coupons')->latest()->get();

            return DataTables::of($coupons)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.offer.coupon.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //coupon store
    public function store(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|unique:coupons',
            'coupon_valid_date' => 'required',
            'coupon_type' => 'required|in:1,2',
            'coupon_amount' => 'required',
            'coupon_status' => 'required|in:1,2',
        ]);

        DB::table('coupons')->insert([
            'coupon_code' => $request->coupon_code,
            'coupon_valid_date' => $request->coupon_valid_date,
            'coupon_type' => $request->coupon_type,
            'coupon_amount' => $request->coupon_amount,
            'coupon_status' => $request->coupon_status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // $notification = array('message' => 'Coupon Added', 'alert_type' => 'success');
        // return back()->with($notification);
        return response()->json('Coupon Added');
    }

    //coupon edit
    public function edit($id)
    {
        $coupon = DB::table('coupons')->where('id', $id)->first();
        return view('admin.offer.coupon.edit', compact('coupon'));
    }

    //coupon update
    public function update(Request $request, $id)
    {
        $request->validate([
            'coupon_code' => 'required|unique:coupons,coupon_code,' . $id,
            'coupon_valid_date' => 'required',
            'coupon_type' => 'required|in:1,2',
            'coupon_amount' => 'required',
            'coupon_status' => 'required|in:1,2',
        ]);

        DB::table('coupons')->where('id', $id)->update([
            'coupon_code' => $request->coupon_code,
            'coupon_valid_date' => $request->coupon_valid_date,
            'coupon_type' => $request->coupon_type,
            'coupon_amount' => $request->coupon_amount,
            'coupon_status' => $request->coupon_status,
            'updated_at' => now(),
        ]);

        return response()->json('Coupon Updated');
    }

    //coupon delete
    public function destroy($id)
    {
        DB::table('coupons')->where('id', $id)->delete();
        // $notification = array('message' => 'Coupon Deleted', 'alert_type' => 'success');
        // return back()->with($notification);
        return response()->json('Coupon Deleted');
    }
}

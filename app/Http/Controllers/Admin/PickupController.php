<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;
use View;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show pickup point list
    public function index()
    {
        return view('admin.pickup_point.index');
    }

    // pickup point data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {
            $pickup_points = DB::table('pickup_point')->latest()->get();

            return DataTables::of($pickup_points)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.pickup_point.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //pickup point store
    public function store(Request $request)
    {
        $request->validate([
            'pickup_point_name' => 'required',
            'pickup_point_address' => 'required',
            'pickup_point_phone' => 'required',
        ]);

        DB::table('pickup_point')->insert([
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json('Pickup Point Added');
    }

    //pickup point edit
    public function edit($id)
    {
        $pickup_point = DB::table('pickup_point')->where('id', $id)->first();
        return view('admin.pickup_point.edit', compact('pickup_point'));
    }

    //pickup point update
    public function update(Request $request, $id)
    {
        $request->validate([
            'pickup_point_name' => 'required',
            'pickup_point_address' => 'required',
            'pickup_point_phone' => 'required',
        ]);

        DB::table('pickup_point')->where('id', $id)->update([
            'pickup_point_name' => $request->pickup_point_name,
            'pickup_point_address' => $request->pickup_point_address,
            'pickup_point_phone' => $request->pickup_point_phone,
            'pickup_point_phone_two' => $request->pickup_point_phone_two,
            'updated_at' => now(),
        ]);

        return response()->json('Pickup Point Updated');
    }

    //pickup point delete
    public function destroy($id)
    {
        DB::table('pickup_point')->where('id', $id)->delete();
        return response()->json('Coupon Deleted');
    }
}

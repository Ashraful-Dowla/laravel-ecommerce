<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;
use View;

class WarehouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show warehouse list
    public function index()
    {
        return view('admin.category.warehouse.index');
    }

    // warehouse data loaded by yajra datatable
    public function list(Request $request) {
        if ($request->ajax()) {
            $warehouses = DB::table('warehouses')->latest()->get();

            return DataTables::of($warehouses)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.category.warehouse.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //warehouse store
    public function store(Request $request)
    {
        $request->validate([
            'warehouse_name' => 'required|unique:warehouses',
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required',
        ]);

        DB::table('warehouses')->insert([
            'warehouse_name' => $request->warehouse_name,
            'warehouse_address' => $request->warehouse_address,
            'warehouse_phone' => $request->warehouse_phone,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Warehouse Added', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //warehouse edit
    public function edit($id)
    {
        $warehouse = DB::table('warehouses')->where('id', $id)->first();
        return view('admin.category.warehouse.edit', compact('warehouse'));
    }

    //warehouse update
    public function update(Request $request, $id)
    {
        $request->validate([
            'warehouse_name' => 'required|unique:warehouses,warehouse_name,' . $id,
            'warehouse_address' => 'required',
            'warehouse_phone' => 'required',
        ]);

        DB::table('warehouses')->where('id', $id)->update([
            'warehouse_name' => $request->warehouse_name,
            'warehouse_address' => $request->warehouse_address,
            'warehouse_phone' => $request->warehouse_phone,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Warehouse Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //warehouse delete
    public function destroy($id)
    {
        DB::table('warehouses')->where('id', $id)->delete();
        $notification = array('message' => 'Warehouse Delted', 'alert_type' => 'success');
        return back()->with($notification);
    }
}

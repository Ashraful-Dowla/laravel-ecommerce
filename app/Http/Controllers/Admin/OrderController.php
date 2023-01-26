<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use DataTables;
use Illuminate\Http\Request;
use View;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show order list
    public function index()
    {
        return view('admin.order.index');
    }

    // order data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {

            $status = $request->status;
            $date = $request->date;
            $payment_type =$request->payment_type;

            $orders = Order::when($status != null, function ($query) use ($status) {
                return $query->where('status', $status);
            })->when($date != null, function ($query) use ($date) {
                return $query->where('date', date('d-m-Y', strtotime($date)));
            })->when($payment_type != null, function ($query) use ($payment_type) {
                return $query->where('payment_type', $payment_type);
            })->get();

            return DataTables::of($orders)
                ->addIndexColumn()
                ->editColumn('status', function ($row) {
                    $order_status = $row->status;
                    return View::make('admin.order.order_status', compact('order_status'));
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.product.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }
}

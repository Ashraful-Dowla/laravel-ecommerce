<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ReceivedMail;
use App\Models\Order;
use DataTables;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
            $payment_type = $request->payment_type;

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
                    $actionBtn = View::make('admin.order.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    //order edit
    public function edit($id)
    {
        $order = Order::where('id', $id)->first();
        return view('admin.order.edit', compact('order'));
    }

    //order update
    public function update(Request $request, $id)
    {
        Order::where('id', $id)->update([
            'c_name' => $request->c_name,
            'c_email' => $request->c_email,
            'c_address' => $request->c_address,
            'c_phone' => $request->c_phone,
            'status' => $request->status,
        ]);

        if ($request->status == 1) {
            Mail::to($request->c_email)->send(new ReceivedMail());
        }

        return response()->json('Order successfully updated');
    }

    //show order
    public function view($id)
    {
        $order = Order::where('id', $id)->first();
        $order_details = DB::table('order_details')->where('order_id', $id)->get();

        return view('admin.order.order_details', compact('order', 'order_details'));
    }

    //order details update
    public function details_update(Request $request, $id)
    {
        $query = Order::where('id', $id);
        $order = $query->first();

        $query->update([
            'status' => $request->status,
        ]);

        if ($request->status == 1) {
            Mail::to($order->c_email)->send(new ReceivedMail());
        }

        return response()->json('Order successfully updated');
    }

    //order delete
    public function destroy($id)
    {
        Order::where('id', $id)->delete();
        DB::table('order_details')->where('order_id', $id)->delete();
        return response()->json('Order successfully deleted');
    }

    //order report index
    public function report_index()
    {
        return view('admin.report.order.index');
    }

    // order report data loaded by yajra datatable
    public function report_list(Request $request)
    {
        if ($request->ajax()) {

            $status = $request->status;
            $date = $request->date;
            $payment_type = $request->payment_type;

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
                ->rawColumns(['status'])
                ->make(true);
        }
    }

    //order report print
    public function report_print(Request $request)
    {
        $orders = Order::all();
        if ($request->ajax()) {

            $status = $request->status;
            $date = $request->date;
            $payment_type = $request->payment_type;

            $orders = Order::when($status != null, function ($query) use ($status) {
                return $query->where('status', $status);
            })->when($date != null, function ($query) use ($date) {
                return $query->where('date', date('d-m-Y', strtotime($date)));
            })->when($payment_type != null, function ($query) use ($payment_type) {
                return $query->where('payment_type', $payment_type);
            })->get();
        }

        return view('admin.report.order.print', compact('orders'));
    }
}

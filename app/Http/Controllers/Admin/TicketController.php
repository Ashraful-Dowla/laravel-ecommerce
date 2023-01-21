<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use App\Models\Ticket;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Image;
use View;

class TicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //show ticket list
    public function index()
    {
        return view('admin.ticket.index');
    }

    // ticket data loaded by yajra datatable
    function list(Request $request) {

        $status = $request->status;
        $date = $request->date;
        $service = $request->service;

        if ($request->ajax()) {

            $tickets = Ticket::when($status != null, function ($query) use ($status) {
                return $query->where('status', $status);
            })->when($date, function ($query) use ($date) {
                return $query->where('date', $date);
            })->when($service, function ($query) use ($service) {
                return $query->where('service', $service);
            })->get();

            return DataTables::of($tickets)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return $row->user->name;
                })
                ->editColumn('date', function ($row) {
                    return date('d F, Y', strtotime($row->date));
                })
                ->editColumn('status', function ($row) {
                    return View::make('admin.ticket.status_action', compact('row'));
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.ticket.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action', 'name', 'status', 'date'])
                ->make(true);
        }
    }

    public function view($id)
    {
        $ticket = Ticket::where('id', $id)->first();
        return view('admin.ticket.view', compact('ticket'));
    }

    public function reply(Request $request)
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

        Ticket::where('id', $request->ticket_id)->update([
            'status' => 1,
        ]);

        $notification = array('message' => 'Ticket Replied', 'alert_type' => 'success');
        return back()->with($notification);
    }

    public function close($id)
    {
        Ticket::where('id', $id)->update([
            'status' => 2,
        ]);

        $notification = array('message' => 'Ticket Closed', 'alert_type' => 'success');
        return redirect()->route('ticket.index')->with($notification);
    }

    public function destroy($id)
    {
        Ticket::destroy($id);
        return response()->json('Ticket Deleted');
    }
}

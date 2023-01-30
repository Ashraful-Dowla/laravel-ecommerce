<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB;
use Illuminate\Http\Request;
use View;

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    //contact
    public function index()
    {
        return view('admin.contact.index');
    }

    // contact data loaded by yajra datatable
    function list(Request $request) {
        if ($request->ajax()) {
            $contacts = DB::table('contacts')->get();

            return DataTables::of($contacts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.contact.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //contact edit
    public function edit($id)
    {
        $contact = DB::table('contacts')->where('id', $id)->first();
        return view('admin.contact.edit', compact('contact'));
    }

    //contact update
    public function update(Request $request, $id)
    {
        DB::table('contacts')->where('id', $id)->update([
            'status' => $request->status,
        ]);

        return response()->json('Contact message status updated!');
    }

    //contact delete
    public function destroy($id)
    {
        DB::table('contacts')->where('id', $id)->delete();
        return response()->json('Contact deleted!');
    }
}

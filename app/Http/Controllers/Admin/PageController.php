<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show page list
    public function index()
    {
        $pages = DB::table('pages')->latest()->get();
        return view('admin.setting.page.index', compact('pages'));
    }

    //page create
    public function create()
    {
        return view('admin.setting.page.create');
    }

    //page store
    public function store(Request $request)
    {
        $request['page_slug'] = Str::slug($request->page_name, '-');

        DB::table('pages')->insert([
            'page_position' => $request->page_position,
            'page_name' => $request->page_name,
            'page_title' => $request->page_title,
            'page_slug' => $request->page_slug,
            'page_description' => $request->page_description,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Page Inserted', 'alert_type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }

    //page edit
    public function edit($id)
    {
        $page = DB::table('pages')->where('id', $id)->first();
        return view('admin.setting.page.edit', compact('page'));
    }

    //page update
    public function update(Request $request, $id)
    {
        $request['page_slug'] = Str::slug($request->page_name, '-');

        DB::table('pages')->where('id', $id)->update([
            'page_position' => $request->page_position,
            'page_name' => $request->page_name,
            'page_title' => $request->page_title,
            'page_slug' => $request->page_slug,
            'page_description' => $request->page_description,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Page Updated', 'alert_type' => 'success');
        return redirect()->route('page.index')->with($notification);
    }

    //page delete
    public function destroy($id)
    {
        DB::table('pages')->where('id', $id)->delete();

        $notification = array('message' => 'Page Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }

}

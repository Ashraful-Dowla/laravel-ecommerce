<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Category, Subcategory};
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show subcategory list
    public function index()
    {
        // $subcategories = DB::table('subcategories')
        //     ->leftJoin('categories', 'subcategories.category_id', 'categories.id')
        //     ->select('subcategories.*', 'categories.category_name')
        //     ->get();

        $subcategories = Subcategory::all();

        // $categories = DB::table('categories')->get();
        $categories = Category::all();

        return view('admin.category.subcategory.index', compact('subcategories', 'categories'));
    }

    public function store(Request $request)
    {
        $request['subcategory_slug'] = Str::slug($request->subcategory_name, '-');

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_name' => 'required|max:100',
        ]);


        // DB::table('subcategories')->insert([
        //     'category_id' => $request->category_id,
        //     'subcategory_name' => $request->subcategory_name,
        //     'subcategory_slug' => $request->subcategory_slug,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => $request->subcategory_slug,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Subcategory Inserted', 'alert_type' => 'success');
        return back()->with($notification);

    }

    // get subcategory by id
    public function edit($id)
    {
        $subcategory = Subcategory::find($id);
        $categories = Category::all();

        return view('admin.category.subcategory.edit', compact('subcategory', 'categories'));
    }

    // subcategory update by id
    public function update(Request $request)
    {
        $request['subcategory_slug'] = Str::slug($request->subcategory_name, '-');

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_name' => 'required|max:100',
        ]);

        Subcategory::where('id',$request->id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => $request->subcategory_slug,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Subcategory Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    // subcategory delete
    public function destroy($id)
    {
        // DB::table('subcategories')->where('id',$id)->delete();
        Subcategory::destroy($id);
        $notification = array('message' => 'Subcategory Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }
}

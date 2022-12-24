<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // show category list
    public function index()
    {
        $categories = DB::table('categories')->get();
        // $categories = Category::all();
        return view('admin.category.category.index', compact('categories'));
    }

    //category store
    public function store(Request $request)
    {
        $request['category_slug'] = Str::slug($request->category_name, '-');
        $request->validate([
            'category_name' => 'required|max:100',
            'category_slug' => 'unique:categories|max:255',
        ]);

        // DB::table('categories')->insert([
        //     'category_name' => $request->category_name,
        //     'category_slug' => $request->category_slug,
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Category Inserted', 'alert_type' => 'success');
        return back()->with($notification);
    }

    // get category by id
    public function edit($id)
    {
        // $data = DB::table('categories')->where('id',$id)->first();
        $data = Category::findOrFail($id);
        return response()->json($data);
    }

    //category update
    public function update(Request $request)
    {
        $request['category_slug'] = Str::slug($request->category_name, '-');
        $request->validate([
            'category_name' => 'required|max:100',
            'category_slug' => 'max:255|unique:categories,category_slug,' . $request->id,
        ]);

        // DB::table('categories')->where('id', $request->id)->update([
        //     'category_name' => $request->category_name,
        //     'category_slug' => $request->category_slug,
        //     'updated_at' => now(),
        // ]);

        Category::where('id', $request->id)->update([
            'category_name' => $request->category_name,
            'category_slug' => $request->category_slug,
            'updated_at' => now(),
        ]);

        $notification = array('message' => 'Category Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //category delete
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        // Category::destroy($id);

        $notification = array('message' => 'Category Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DataTables;
use DB, View;
use Illuminate\Http\Request;
use App\Models\{Category, Subcategory};
use Illuminate\Support\Str;

class ChildcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show childcategory list
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.childcategory.index', compact('categories'));
    }

    // childcategory data loaded by yajra datatable
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $childcategories = DB::table('childcategories')
                ->leftJoin('categories', 'childcategories.category_id', 'categories.id')
                ->leftJoin('subcategories', 'childcategories.subcategory_id', 'subcategories.id')
                ->select('childcategories.*', 'categories.category_name', 'subcategories.subcategory_name')
                ->get();

            return DataTables::of($childcategories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = View::make('admin.category.childcategory.action', compact('row'));
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    //childcategory store
    public function store(Request $request)
    {
        $request['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'childcategory_name' => 'required|max:100'
        ]);

        DB::table('childcategories')->insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_name' => $request->childcategory_name,
            'childcategory_slug' => $request->childcategory_slug,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $notification = array('message' => 'Childcategory Inserted', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //get subcategory by category Id
    public function getSubcategoryByCategoryId($id)
    {
        $subcategories = Subcategory::where('category_id',$id)->get();
        return response()->json($subcategories);
    }

    //childcategory edit
    public function edit($id)
    {
        $childcategory = DB::table('childcategories')->where('id',$id)->first();
        $categories = Category::all();
        $subcategories =  Subcategory::where('category_id',$childcategory->category_id)->get();

        return view('admin.category.childcategory.edit', compact('categories','subcategories','childcategory'));
    }

    //chilcategory update
    public function update(Request $request)
    {
        $request['childcategory_slug'] = Str::slug($request->childcategory_name, '-');
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'childcategory_name' => 'required|max:100'
        ]);

        DB::table('childcategories')->where('id',$request->id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'childcategory_name' => $request->childcategory_name,
            'childcategory_slug' => $request->childcategory_slug,
            'updated_at' => now()
        ]);

        $notification = array('message' => 'Childcategory Updated', 'alert_type' => 'success');
        return back()->with($notification);
    }

    //childcategory delete
    public function destroy($id)
    {
        DB::table('childcategories')->where('id',$id)->delete();
        $notification = array('message' => 'Childcategory Deleted', 'alert_type' => 'success');
        return back()->with($notification);
    }
}

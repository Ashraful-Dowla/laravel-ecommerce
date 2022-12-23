<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Category;

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
}

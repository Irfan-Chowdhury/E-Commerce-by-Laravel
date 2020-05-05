<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Brand;
use DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.product.index');   
    }

    public function create()
    {
        $categories = Category::all();
    	$brands     = Brand::all();
    	return view('admin.product.create',compact('categories','brands'));
    }

    //subcategory by ajax request
    public function getSubCategory($category_id)
    {
        $cat = DB::table("subcategories")->where("category_id",$category_id)->get();
        return json_encode($cat);
    }
}

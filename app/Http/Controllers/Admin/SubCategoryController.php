<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Category;
use DB;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subCategory()
    {
        $categories     = DB::table('categories')->get();
        
        $subCategories  = DB::table('subcategories')
                        ->select('subcategories.*','categories.category_name')
                        ->join('categories','subcategories.category_id','categories.id')
                        ->orderBy('categories.category_name','ASC')
                        ->get();
               
        return view('admin.subcategory.subcategory',compact('categories','subCategories'));
    }

    public function subCategoryStore(Request $request)
    {
    	$validatedData = $request->validate([
            'category_id'      => 'required',
            'subcategory_name' => 'required|unique:subcategories|max:55',
        ]);

        $data                     = array();
        $data['category_id']      = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;

        DB::table('subcategories')->insert($data);
        $notification = array(
            'messege'=>'Sub Category Inserted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification); 
    }

    public function subCategoryDelete($id)
    {
    	DB::table('subcategories')->where('id',$id)->delete();
        $notification = array(
            'messege'=>'Sub Category Deleted',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification); 
    }

    
    public function subCategoryEdit($id)
    {
    	$subCategory = DB::table('subcategories')->where('id',$id)->first();
        $categories     = DB::table('categories')->get();
        
    	return view('admin.subcategory.edit_subcategory',compact('subCategory','categories'));
    }

    public function subCategoryUpdate(Request $request,$id)
    {
    	$data                     = array();
        $data['category_id']      = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        DB::table('subcategories')->where('id',$id)->update($data);
        $notification             = array(
            'messege'=>'Sub Category Updated',
            'alert-type'=>'success'
        );
        return Redirect()->route('subcategory')->with($notification); 
    }
}

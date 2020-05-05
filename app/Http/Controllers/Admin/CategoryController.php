<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function category()
    {
        $category = Category::all();

        return view('admin.category.category',compact('category'));
    }

    public function storeCatgory(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:55',
            ]);
    
        // $data=array();
        // $data['category_name'] = $request->category_name;
        // DB::table('categories')->insert($data);

        $category = new Category();
        $category->category_name =$request->category_name;
        $category->save();

        $notification= array(
            'messege'=>'Category Insert Done',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function deleteCategory($id)
    {
        DB::table('categories')->where('id',$id)->delete();
    	$notification = array(
            'messege'=>'Category Successfully Deleted',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }

    public function editCategory($id)
    {
        $category = DB::table('categories')->where('id',$id)->first();

    	return view('admin.category.edit_category',compact('category'));
    }


    public function updateCategory(Request $request,$id)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|max:55',
            ]);

        $data=array();
        $data['category_name']=$request->category_name;
        $update= DB::table('categories')->where('id',$id)->update($data);

        if ($update) {
            $notification=array(
                'messege'=>'Category Successfully Updated',
                'alert-type'=>'success'
            );

            return Redirect()->route('categories')->with($notification);

        }
        else{
            $notification=array(
                'messege'=>'Nothing to update',
                'alert-type'=>'success'
            );
            
            return Redirect()->route('categories')->with($notification);
        }
    }

}

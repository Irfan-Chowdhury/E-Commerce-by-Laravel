<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Newslater;
use App\Model\Admin\Brand;
use DB;

class FrontController extends Controller
{

    public function index()
    {
        $new_featured = DB::table('products')
                    ->where('status',1)
                    ->orderBy('id','desc')
                    ->limit(24)
                    ->get(); 

        $trends    = DB::table('products')
                    ->where('status',1)
                    ->where('trend',1)
                    ->orderBy('id','desc')
                    ->limit(24)
                    ->get();

        $best_rated = DB::table('products')
                    ->where('status',1)
                    ->where('best_rated',1)
                    ->orderBy('id','desc')
                    ->limit(24)
                    ->get();

        $hot_deal   = DB::table('products')
                    ->select('brands.brand_name','products.*')
                    ->join('brands','products.brand_id','brands.id')
                    ->where('products.status',1)
                    ->where('hot_deal',1)
                    ->orderBy('id','desc')
                    ->limit(4)->get();
        
        $brands     = Brand::all(); 

        $mid_slider = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('brands','products.brand_id','brands.id')
                    ->select('products.*','brands.brand_name','categories.category_name')
                    ->where('products.mid_slider',1)
                    ->orderBy('id','DESC')
                    ->limit(4)
                    ->get();
        
        return view('pages.index',compact('new_featured','trends','best_rated','hot_deal','brands','mid_slider'));
    }


    public function newslaterStore(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:newslaters|max:55',
        ]);

        $newslater        = new Newslater();
        $newslater->email = $request->email;
        $newslater->save();
        
        $notification  = array(
            'messege'   =>'Thanks for subscribing ',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }
}

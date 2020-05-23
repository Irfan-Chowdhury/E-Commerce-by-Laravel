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
        
        $buyone_getone = DB::table('products')->where('status',1)->where('buyone_getone',1)->orderBy('id','desc')->limit(12)->get();

        return view('pages.index',compact('new_featured','trends','best_rated','hot_deal','brands','mid_slider','buyone_getone'));
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


    public function orderTracking(Request $request)
    {

         $track = DB::table('orders')->where('status_code',$request->status_code)->first();
         
         if ($track) 
         {             
            return view('pages.track',compact('track'));
         }
         else
         {
            $notification=array(
                'messege'=>'Status code invalid ',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
         }

    }

    //Product Search
    public function ProductSearch(Request $request)
    {
        $item = $request->search;

        $categories = DB::table('categories')->get();
        
        $brands     = DB::table('brands')->get();

        $products   = DB::table('products')
                    ->select('products.*','brands.brand_name')
                    ->join('brands','products.brand_id','brands.id')
                    ->where('product_name','LIKE', "%{$item}%")
                    ->orWhere('brand_name','LIKE', "%{$item}%")
                    ->paginate(20);

        // return $products;  
        
        return view('pages.search',compact('categories','brands','products'));       
    }
}

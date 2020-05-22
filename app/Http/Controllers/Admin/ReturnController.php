<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function returnRequest()
    {
    	 $orders = DB::table('orders')->where('return_order', 1)->get();
    	 return view('admin.return.request',compact('orders'));
    }

    public function returnApprove($id)
    {
        DB::table('orders')->where('id',$id)->update(['return_order'=> 2 ]);

        $notification=array(
            'messege'=>'Return Successfully done',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function returnAll()
    {
    	 $order = DB::table('orders')->where('return_order', 2)->get();
    	 return view('admin.return.all',compact('order'));
    }
}

// Return-1 => Pending
// Return-2 => Success

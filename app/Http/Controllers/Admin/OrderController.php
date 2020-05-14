<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Order;
use App\Model\Admin\Shipping;
use DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function orderNew()
    {
        //  $order = DB::table('orders')->where('status',0)->get();
        
        $orders = Order::where('status',0)->orderBy('id','DESC')->get();

    	return view('admin.order.new',compact('orders'));
    }


    public function orderView($id)
    {
            $order = DB::table('orders')
                    ->select('users.name','users.phone','orders.*')
                    ->join('users','orders.user_id','users.id')
                    ->where('orders.id',$id)
                    ->first();

         $order_details  = DB::table('order_details')
                    ->select('products.product_code','products.image_one','order_details.*')
                    ->join('products','order_details.product_id','products.id')
                    ->where('order_details.order_id',$id)
                    ->get();

        //  $shipping = DB::table('shippings')->where('order_id',$id)->first();
    	 $shipping = Shipping::where('order_id',$id)->first();


          return view('admin.order.view',compact('order','order_details','shipping'));
    }
}

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
        
        $orders = Order::orderBy('id','DESC')->where('status',0)->get();

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

    //--- Payment Accept ---
    public function orderPaymentAccept($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=> 1]);

        $notification=array(
            'messege'=>'Payment Accept Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('order.new')->with($notification);
    }


    public function orderPaymentAcceptList()
    {
        $orders = Order::orderBy('id','DESC')->where('status', 1)->get();

    	return view('admin.order.new',compact('orders'));
    }


    // ---- Order Delivery ----
    public function orderDeliveryProgress($id)
    {
        DB::table('orders')->where('id',$id)->update(['status' => 2]);

        $notification = array(
            'messege'=>'Send To delivery',
            'alert-type'=>'success'
        );
        return Redirect()->route('order.payment.accept.list')->with($notification);
    }

    public function orderDeliveryProgressList()
    {
        $orders = Order::orderBy('id','DESC')->where('status',2)->get();;
        return view('admin.order.new',compact('orders'));
    }


    // --- Delivery Done ---
    public function orderDeliveryDone($id)
    {

        // $product = DB::table('order_details')->where('order_id',$id)->get();

        // foreach ($product as $row) {
        //     DB::table('products')
        //       ->where('id',$row->product_id)
        //       ->update(['product_quantity' => DB::raw('product_quantity -'.$row->quantity)]);
        // }

        DB::table('orders')->where('id',$id)->update(['status' => 3]);
        
        $notification=array(
            'messege'=>'Delivery Successfully Done',
            'alert-type'=>'success'
        );
        return Redirect()->route('order.delivery.progress.list')->with($notification);
    }


    public function orderDeliverySuccessList()
    {
        $orders = Order::orderBy('id','DESC')->where('status',3)->get();
        return view('admin.order.new',compact('orders'));
    }


    //-- Order Payment Cancel ---
    public function orderPaymentCancel($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=> 4]);

        $notification=array(
            'messege'=>'Order Cancel',
            'alert-type'=>'success'
        );
        return Redirect()->route('order.new')->with($notification);
    }

    public function orderPaymentCancelList()
    {
        $orders = Order::orderBy('id','DESC')->where('status',4)->get();
        return view('admin.order.new',compact('orders'));
    }
}

// 1 - Pending
// 2 - Payment Accept
// 3 - Progress
// 4 - Delivered
// else - Cancel
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Coupon;
use DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function coupon()
    {
        $coupon = Coupon::orderBy('id','DESC')->get();

    	return view('admin.coupon.coupon',compact('coupon'));
    }

    public function couponStore(Request $request)
    {
        $validatedData = $request->validate([
            'coupon' => 'required',
            'discount' => 'required',
        ]);
        
        $data           = new Coupon();
        $data->coupon   = $request->coupon;
        $data->discount = $request->discount;
        $data->save();

    	$notification = array(
            'messege'=>'Coupon Insert Done',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function couponDelete($id)
    {
        $coupon = Coupon::find($id);
        $coupon->delete();

    	$notification = array(
            'messege'=>'Coupon Delete Done',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function couponEdit($id)
    {
    	$coupon = Coupon::find($id);
    	return view('admin.coupon.edit_coupon',compact('coupon'));
    }

    public function couponUpdate(Request $request, $id)
    {
        $validatedData = $request->validate([
            'coupon' => 'required',
            'discount' => 'required',
        ]);

        $data           = Coupon::find($id);
        $data->coupon   = $request->coupon;
        $data->discount = $request->discount;
        $data->update();

    	$notification  = array(
            'messege'=>'Coupon Updated Done',
            'alert-type'=>'success'
        );
        
        return Redirect()->route('coupon')->with($notification);
    }
}

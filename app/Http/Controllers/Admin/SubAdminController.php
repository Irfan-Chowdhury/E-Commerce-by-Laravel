<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class SubAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function subAdminAll()
    {
        $admins = DB::table('admins')->where('type',2)->get();
    	return view('admin.sub-admin.all-subadmin',compact('admins'));
    }
    
    public function subAdminCreate()
    {
        return view('admin.sub-admin.create');
    }

    public function subAdminStore(Request $request)
    {
        $data = array();
        $data['name']     = $request->name;
        $data['phone']    = $request->phone;
        $data['email']    = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['category'] = $request->category;
        $data['coupon']   = $request->coupon;
        $data['product']  = $request->product;
        $data['blog']     = $request->blog;
        $data['order']    = $request->order;
        $data['report']   = $request->report;
        $data['role']     = $request->role;
        $data['return']   = $request->return;
        $data['contact']  = $request->contact;
        $data['comment']  = $request->comment;
        $data['setting']  = $request->setting;
        $data['stock']    = $request->stock;
        $data['other']    = $request->other;
        $data['type']     = 2; //Sub-Admin

        DB::table('admins')->insert($data);
        
        $notification=array(
            'messege'=>'Sub-Admin Created Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function subAdminDelete($id)
    {
        DB::table('admins')->where('id',$id)->delete();
    	$notification=array(
            'messege'=>' Admin Delete Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function subAdminEdit($id)
    {
    	 $user=DB::table('admins')->where('id',$id)->first();
    	 return view('admin.sub-admin.edit',compact('user'));
    }


    public function subAdminUpdate(Request $request, $id)
    {
        $data = array();
        $data['name']     = $request->name;
        $data['phone']    = $request->phone;
        $data['email']    = $request->email;
        $data['category'] = $request->category;
        $data['coupon']   = $request->coupon;
        $data['product']  = $request->product;
        $data['blog']     = $request->blog;
        $data['order']    = $request->order;
        $data['report']   = $request->report;
        $data['role']     = $request->role;
        $data['return']   = $request->return;
        $data['contact']  = $request->contact;
        $data['comment']  = $request->comment;
        $data['setting']  = $request->setting;
        $data['stock']    = $request->stock;
        $data['other']    = $request->other;

        DB::table('admins')->where('id',$id)->update($data);

        $notification=array(
            'messege'=>'Sub-Admin Update Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->route('sub-admin.all')->with($notification);
    }
}

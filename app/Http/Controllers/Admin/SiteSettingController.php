<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\SiteSetting;
use DB;

class SiteSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function siteSetting()
    {
        // $setting = DB::table('site_settings')->first();
        $setting = SiteSetting::first();

        return view('admin.site-setting.site_setting',compact('setting'));
    }

    public function siteSettingUpdate(Request $request, $id)
    {
        $setting = SiteSetting::find($id);

        $setting->phone_one       = $request->phone_one;
        $setting->phone_two       = $request->phone_two;
        $setting->email           = $request->email;
        $setting->company_name    = $request->company_name;
        $setting->company_address = $request->company_address;
        $setting->facebook        = $request->facebook;
        $setting->youtube         = $request->youtube;
        $setting->instagram       = $request->instagram;
        $setting->twitter         = $request->twitter;
        $setting->update();

        $notification=array(
            'messege'=>'Setting Updated Successfully',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }
}

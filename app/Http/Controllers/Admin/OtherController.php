<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Newslater;
use DB;

class OtherController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

        // ============ Newslater ============

    public function newslater()
    {
        $sub = Newslater::orderBy('id','DESC')->get();
        return view('admin.newslater.newslater',compact('sub'));
    }

    public function newslaterDelete($id)
    {
        // DB::table('newslaters')->where('id',$id)->delete();
        $newslater = Newslater::find($id);
        $newslater->delete();
        
        $notification=array(
            'messege'=>'Subscriber Deleted Done',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }




        // ============ SEO ============

    public function seo()
    {
        $seo = DB::table('seo')->first();
        return view('admin.seo.seo',compact('seo'));
    }

    public function seoUpdate(Request $request, $id)
    {
         $data=array();
         $data['meta_title']=$request->meta_title;
         $data['meta_author']=$request->meta_author;
         $data['meta_tag']=$request->meta_tag;
         $data['meta_description']=$request->meta_description;
         $data['google_analytics']=$request->google_analytics;
         $data['bing_analytics']=$request->bing_analytics;
         DB::table('seo')->where('id',$id)->update($data);

         $notification=array(
            'messege'=>'SEO Updated Successfully',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }
}

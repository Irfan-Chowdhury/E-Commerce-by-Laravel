<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Newslater;
use DB;

class NewslaterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

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
}

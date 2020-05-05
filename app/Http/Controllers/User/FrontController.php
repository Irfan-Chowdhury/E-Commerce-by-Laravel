<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Newslater;

class FrontController extends Controller
{
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

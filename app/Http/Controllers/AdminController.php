<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Admin;
use DB;
class AdminController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date            = date("d-m-y");
        $today_order     = DB::table('orders')->where('date',$date)->get();
        $today           = $this->total_sum($today_order);

        $today_delivery  = DB::table('orders')->where('date',$date)->where('status', 3)->get(); //3 means delivered
        $delivery        = $this->total_sum($today_delivery);

        $month           = date("F");
        $this_month_data = DB::table('orders')->where('month',$month)->where('status', 3)->get(); //3 means delivered
        $month_sales     = $this->total_sum($this_month_data);

        $year            = date('Y');
        $this_year_data  = DB::table('orders')->where('year',$year)->where('status', 3)->get(); //3 means delivered
        $year_sales      = $this->total_sum($this_year_data);

        $return_data     = DB::table('orders')->where('return_order',2)->get();
        $return          = $this->total_sum($return_data);

        $products         = DB::table('products')->get();
        $brands           = DB::table('brands')->get();
        $users            = DB::table('users')->get();


        return view('admin.home',compact('today','delivery','month_sales','year_sales','return','products','brands','users'));
    }

    protected function total_sum($data)
    {
        // $data = DB::table('orders')->where('date',$date)->get();

        $sum = 0;
        foreach($data as $item){
            $sum += implode(explode(',',$item->total)); //Remove Comma (,) || Convert 10,500.00 to 10500.00
        }
        
        $result =  number_format(implode(explode(',',($sum)))) ; //With Comma (,) || Convert 10500.00 to 10,500.00  
        return $result;
    }


//---------------------------------------------
//---------------------------------------------



    public function ChangePassword()
    {
        return view('admin.auth.passwordchange');
    }

    public function Update_pass(Request $request)
    {
      $password=Auth::user()->password;
      $oldpass=$request->oldpass;
      $newpass=$request->password;
      $confirm=$request->password_confirmation;
      if (Hash::check($oldpass,$password)) {
           if ($newpass === $confirm) {
                      $user=Admin::find(Auth::id());
                      $user->password=Hash::make($request->password);
                      $user->save();
                      Auth::logout();
                      $notification=array(
                        'messege'=>'Password Changed Successfully ! Now Login with Your New Password',
                        'alert-type'=>'success'
                         );
                       return Redirect()->route('admin.login')->with($notification);
                 }else{
                     $notification=array(
                        'messege'=>'New password and Confirm Password not matched!',
                        'alert-type'=>'error'
                         );
                       return Redirect()->back()->with($notification);
                 }
      }else{
        $notification=array(
                'messege'=>'Old Password not matched!',
                'alert-type'=>'error'
                 );
               return Redirect()->back()->with($notification);
      }
    }

    public function logout()
    {
        Auth::logout();
            $notification=array(
                'messege'=>'Successfully Logout',
                'alert-type'=>'success'
                 );
             return Redirect()->route('admin.login')->with($notification);
    }




}

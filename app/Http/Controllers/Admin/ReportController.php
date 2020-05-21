<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Admin\Order;
use Illuminate\Support\Facades\Hash;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function todayOrder()
    {
    	  $today = date('d-m-y');
    	  $order = DB::table('orders')->where('status',0)->where('date',$today)->get();
    	  return view('admin.report.today_order',compact('order'));
    }

    public function todayDelevered()
    {
          $today = date('d-m-y');
    	  $order = DB::table('orders')->where('status',3)->where('date',$today)->get();
    	  return view('admin.report.today_order',compact('order'));
    }

    public function thisMonth()
    {
    	  $month = date('F');
    	  $order=DB::table('orders')->where('status',3)->where('month',$month)->get();
    	  return view('admin.report.today_order',compact('order'));
    }

    public function search()
    {
    	 return view('admin.report.search');
    }

    public function searchByDate(Request $request)
    {
        $date = date("d-m-y", strtotime($request->date));
        
        $order = Order::where('status',3)->where('date',$date)->get();

        $total = $this->total_sum($order); //call to 'total_sum()' function 
        // return $total;

        return view('admin.report.search_report',compact('order','total'));
    }

    public function searchByMonth(Request $request)
    {
        $month = $request->month;

        $order = Order::where('status',3)->where('month',$month)->get();

        $total = $this->total_sum($order); //call to 'total_sum()' function 

        return view('admin.report.search_report',compact('order','total'));
    }

    public function searchByYear(Request $request)
    {
        $year  = $request->year;
     
        $order = Order::where('status',3)->where('year',$year)->get();

        $total = $this->total_sum($order); //call to 'total_sum()' function 
     
        return view('admin.report.search_report',compact('order','total'));
    }

    protected function total_sum($order)
    {
        // $order = Order::where('status',3)->where('year',$year)->get();

        $sum = 0;
        foreach($order as $item){
            $sum += implode(explode(',',$item->total)); //Remove Comma (,) || Convert 10,500.00 to 10500.00
        }
        
        $result =  number_format(implode(explode(',',($sum))) , 2) ; //With Comma (,) || Convert 10500.00 to 10,500.00  
        return $result;
    }

}


// 1 - Pending
// 2 - Payment Accept
// 3 - Progress
// 4 - Delivered
// else - Cancel

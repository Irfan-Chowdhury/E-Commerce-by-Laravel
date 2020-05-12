<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function paymentProcess(Request $request)
    {
        $data=array();

        $data['name']   = $request->name;
        $data['email']  = $request->email;
        $data['phone']  = $request->phone;
        $data['address']= $request->address;
        $data['city']   = $request->city;
        $data['payment']= $request->payment;

        if ($request->payment == 'stripe') 
        {
            //stripe payment pages
            return view('pages.payment.stripe',compact('data'));
        
        }
        elseif($request->payment == 'paypal')
        {
            echo  "Paypal";
        }
        elseif($request->payment == 'ideal')
        {
            echo  "Ideal";
        }
        elseif($request->payment == 'hand_to_hand_cash')
        {
            echo  "Hand Cash";
        }

    }
}

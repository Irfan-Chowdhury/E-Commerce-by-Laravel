<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Cart;
use Session;

class PaymentController extends Controller
{
    public function paymentPage()
    {
        $setting          = DB::table('settings')->first();
        $shipping_charge  = $setting->shipping_charge;
        $vat              = $setting->vat;
        
        $cart = Cart::content();
        return view('pages.payment',compact('cart','shipping_charge','vat'));
    }


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


    // ===== Original Formate (Internation in "Dollar") =====

    public function stripeCharge(Request $request) //একই Token এ ডাবল রি-সাবমিট করা যায় না 
    {

        $total = implode(explode(',',$request->total)) ;  //convert into integer like- 10,500.00 to 10500 || already checked coupon exists or not in "strip.blade.php"



        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/account/apikeys
        \Stripe\Stripe::setApiKey('sk_test_2z2t2Gmj81a5RtErLGr2d3bj00M58lkUSX'); //this key collect from strip.com account


        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount'      => $total * 100 ,  // amount টা Cent আকারে ডাটা রিসিভ করে । বাট strip গেটওয়েতে এটাকে ডলারে দেখতে/কনভার্ট করতে হলে ১০০ দিয়ে গুণ করতে হবে ।  
            'currency'    => 'usd',
            'description' => 'E-Commerce by Irfan Chowdhury',
            'source' => $token,
            // 'metadata' => ['order_id' => '6735'],
            'metadata'    => ['order_id' => uniqid()],
        ]);


        //return $charge; //check by typing code in front (payment/stripe/charge) || Copy the 5-no point info


        // ========= insert data into "orders" table ============
        
        $data  = array();
        $data['user_id']         = Auth::id();
        $data['payment_id']      = $charge->payment_method;
        $data['payment_type']    = $request->payment_type;
        $data['paying_amount']   = number_format(implode(explode(',',($charge->amount / 100))) , 2) ; // //convert into like- 10500 to 10,500.00 || must be divided by 100 for showing original price otherwise it will show cent formate
        $data['blnc_transection']= $charge->balance_transaction;
        $data['quantity']        = Cart::count();

        if (Session::has('coupon')) 
        {
            $data['coupon']      = Session::get('coupon')['name'];
            $data['subtotal']    = Session::get('coupon')['balance'];
        } 
        else 
        {
            $data['subtotal']    = Cart::Subtotal();
        }

        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping_charge'] = $request->shipping_charge;
        $data['vat']             = $request->vat;
        $data['total']           = $request->total;
        $data['status']  = 0;
        $data['date']    = date('d-m-y');
        $data['month']   = date('F');
        $data['year']    = date('Y');
        
        // return $data;

        // $data['status_code'] = mt_rand(100000, 999999);
        $order_id        = DB::table('orders')->insertGetId($data);


        // ============ insert data into "order_deatils" table ============

        $content    = Cart::content(); //Details in "CartController"
        $details    = array();
        foreach ($content as $row) // প্রত্যেকটা প্রোডাক্টের জন্য cart details "content" এর মধ্যে Array আকারে জমা হয় । 
        {
            $details['order_id']    = $order_id;
            $details['product_id']  = $row->id; //Cart -> id 
            $details['product_name']= $row->name; //Cart -> name
            $details['color']       = $row->options->color; //Cart -> color
            $details['size']        = $row->options->size; //Cart -> size
            $details['quantity']    = $row->qty; //Cart -> quantity
            $details['singleprice'] = $row->price; //Cart -> price
            $details['totalprice']  = $row->qty * $row->price; //Cart -> quantity* price
            DB::table('order_details')->insert($details);
        }

        // ============ insert data into "shipping" table ============

        $shipping = array();
        $shipping['order_id']       = $order_id;
        $shipping['ship_name']      = $request->ship_name;
        $shipping['ship_email']     = $request->ship_email;
        $shipping['ship_phone']     = $request->ship_phone;
        $shipping['ship_address']   = $request->ship_address;
        $shipping['ship_city']      = $request->ship_city;
        DB::table('shippings')->insert($shipping);

        //Then Finally Cart & Session Destroy

        Cart::destroy();

        if (Session::has('coupon')) 
        {
            Session::forget('coupon');
        }
        $notification = array(
            'messege' => 'Payment Successfully Done',
            'alert-type' => 'success',
        );
        return Redirect()->to('/')->with($notification);
    }





    // ====== For Bangladesh ======

    // public function stripeCharge(Request $request) //একই Token এ ডাবল রি-সাবমিট করা যায় না 
    // {
        //     $total = implode(explode(',',$request->total)) ;  //convert into integer like- 10,500.00 to 10500 || already checked coupon exists or not in "strip.blade.php"

        //     // Set your secret key. Remember to switch to your live secret key in production!
        //     // See your keys here: https://dashboard.stripe.com/account/apikeys
        //     \Stripe\Stripe::setApiKey('sk_test_2z2t2Gmj81a5RtErLGr2d3bj00M58lkUSX'); //this key collect from strip.com account

        //     // Token is created using Checkout or Elements!
        //     // Get the payment token ID submitted by the form:
        //     $token = $_POST['stripeToken'];

        //     $charge = \Stripe\Charge::create([
        //         'amount' => $total * (100 * 0.012),  // amount টা Cent আকারে ডাটা রিসিভ করে । strip গেটওয়েতে এটাকে ডলারে দেখতে/কনভার্ট করতে হলে ১০০ দিয়ে গুণ করতে হবে । On the other hand muliplying by 0.012 means Convert 'Taka' Convert to 'Dollar' into strip.com   
        //         'currency' => 'usd',
        //         'description' => 'E-Commerce by Irfan Chowdhury',
        //         'source' => $token,
        //         // 'metadata' => ['order_id' => '6735'],
        //         'metadata' => ['order_id' => uniqid()],
        //     ]);

        //     //return $charge; //check by typing code in front (payment/stripe/charge) || Copy the 5-no point info

        //     // insert into "orders" table
        //     $data = array();
        //     $data['user_id'] = Auth::id();
        //     $data['payment_id'] = $charge->payment_method;
        //     $data['paying_amount'] = number_format(implode(explode(',',($charge->amount / (100 * 0.012 )))) , 2)  ; // divided by 100 means for showing original price otherwise it will show cent formate || & by 0.012 means 'Dollar' convert to 'Taka' where store in database
        //     $data['blnc_transection'] = $charge->balance_transaction;
        //     $data['stripe_order_id'] = $charge->metadata->order_id;
        //     $data['shipping_charge'] = $request->shipping_charge;
        //     $data['vat'] = $request->vat;
        //     $data['total'] = $request->total;
        //     $data['payment_type'] = $request->payment_type;
        //     if (Session::has('coupon')) 
        //     {
        //         $data['subtotal'] = Session::get('coupon')['balance'];
        //     } else {
        //         $data['subtotal'] = Cart::Subtotal();
        //     }
        //     //return $data;
        //     $data['status'] = 0;
        //     $data['date'] = date('d-m-y');
        //     $data['month'] = date('F');
        //     $data['year'] = date('Y');
        //     // $data['status_code'] = mt_rand(100000, 999999);
        //     $order_id = DB::table('orders')->insertGetId($data);

        //     //insert data into "order_deatils" table
        //     $content = Cart::content(); //Details in "CartController"
        //     $details = array();
        //     foreach ($content as $row) // প্রত্যেকটা প্রোডাক্টের জন্য cart details "content" এর মধ্যে Array আকারে জমা হয় । 
        //     {
        //         $details['order_id']= $order_id;
        //         $details['product_id']=$row->id; //Cart -> id 
        //         $details['product_name']=$row->name; //Cart -> name
        //         $details['color']=$row->options->color; //Cart -> color
        //         $details['size']=$row->options->size; //Cart -> size
        //         $details['quantity']=$row->qty; //Cart -> quantity
        //         $details['singleprice']=$row->price; //Cart -> price
        //         $details['totalprice']=$row->qty * $row->price; //Cart -> quantity* price
        //         DB::table('order_details')->insert($details);
        //     }

        //     // insert data into "shipping" table
        //     $shipping=array();
        //     $shipping['order_id']=$order_id;
        //     $shipping['ship_name']=$request->ship_name;
        //     $shipping['ship_email']=$request->ship_email;
        //     $shipping['ship_phone']=$request->ship_phone;
        //     $shipping['ship_address']=$request->ship_address;
        //     $shipping['ship_city']=$request->ship_city;
        //     DB::table('shipping')->insert($shipping);

        //     //Then Finally Cart & Session Destroy

        //     Cart::destroy();

        //     if (Session::has('coupon')) 
        //     {
        //         Session::forget('coupon');
        //     }
        //     $notification = array(
        //         'messege' => 'Payment Successfully Done',
        //         'alert-type' => 'success',
        //     );
        //     return Redirect()->to('/')->with($notification);
    // }
}




// ============ Instruction of "Stripe" Payment Gateway Setup =======

// 0. First need to create account on "stripe.com"

// 1.For HTML,CSS,Javascript Documents for "stripe.blade.php"
// https://stripe.com/docs/stripe-js 


// 2.goto-> https://stripe.com/docs/payments/charges-api
// then go => "Storing information in metadata" and copy the PHP code then paste in this controller's  method "stripeCharge()" .


// 3.Install Strip->
// https://stripe.com/docs/libraries
// Go TO=> (Developement) Api -> Libraries -> Server-side libraries -> copy the PHP command


// 4.For Secret Key -> (already by default set in - 2. no point)
// https://dashboard.stripe.com/test/apikeys



// 5. For Checking
// 4242 4242 4242 4242
// 05 / 20   123  12321

// 6. For Checking-> after submit then goto this link
// https://dashboard.stripe.com/test/payments
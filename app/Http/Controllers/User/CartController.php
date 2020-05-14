<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Setting;
use DB;
use Cart;
use Response;
use Auth;
use Session;

class CartController extends Controller
{
    public function cartAdd($id)
    {
        $product = DB::table('products')->where('id',$id)->first();

        $data    = array();

        if ($product->discount_price == NULL) 
        {
            $data['id']     = $product->id;
            $data['name']   = $product->product_name;
            $data['qty']    = 1;
            $data['price']  = $product->selling_price;  //Original Price bcz it has no discount       
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = '';
            $data['options']['size']  = '';

            Cart::add($data);
            return response()->json(['success' => 'Successfully Added on your Cart']);
        }
        else
        {
            $data['id']    = $product->id;
            $data['name']  = $product->product_name;
            $data['qty']   = 1;
            $data['price'] = $product->discount_price;  //Discount Price, not original price     
            $data['weight']= 1;
            $data['options']['image'] = $product->image_one;  
            $data['options']['color'] = '';
            $data['options']['size']  = ''; 
            
            Cart::add($data);  
            return response()->json(['success' => 'Successfully Added on your Cart']);   
        }
    }

    public function check()
    {
    	$content=Cart::content();
    	return response()->json($content);
    }

    public function showCart()
    {
        $cart = Cart::content();
        return view('pages.cart',compact('cart'));
    }

    public function removeCartById($rowId)
    {
        Cart::remove($rowId);
        
        $notification  = array(
            'messege'   =>'Removed Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    // public function updateCart(Request $request)
    // {
    //     $rowId = $request->productid;
    //     $qty   = $request->qty;

    //     Cart::update($rowId, $qty);

    //     return redirect()->back();
    // }
    public function updateCart(Request $request, $rowId)
    {
        $qty   = $request->qty;

        Cart::update($rowId, $qty);

        $notification  = array(
            'messege'   =>'Updated Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }


    // ==============  By Modal ==============

    public function viewProduct($id)
    {
        $product = DB::table('products')
                ->join('categories','products.category_id','categories.id')
                ->join('subcategories','products.subcategory_id','subcategories.id')
                ->join('brands','products.brand_id','brands.id')
                ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                ->where('products.id',$id)->first();

        $color         = $product->product_color;
        $product_color = explode(',', $color);

        $size          = $product->product_size;
        $product_size  = explode(',', $size);
        
        // return response()->json($product_color);
        return Response::json(array(
            'product' => $product,
            'color'   => $product_color,
            'size'    => $product_size,
        ));

    }

    public function insertIntoCart(Request $request)
    {
        $id     = $request->product_id;
        $product= DB::table('products')->where('id',$id)->first();
        $data   = array();

        if ($product->discount_price == NULL) 
        { 
            $data['id']     = $product->id;
            $data['name']   = $product->product_name;
            $data['qty']    = $request->qty;;
            $data['price']  = $product->selling_price;          
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;
            $data['options']['color'] = $request->color;
            $data['options']['size']  = $request->size;

            Cart::add($data);
            $notification=array(
                'messege'   =>'Add to Cart Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
        else
        {
            $data['id']     = $product->id;
            $data['name']   = $product->product_name;
            $data['qty']    = $request->qty;;
            $data['price']  = $product->discount_price;          
            $data['weight'] = 1;
            $data['options']['image'] = $product->image_one;  
            $data['options']['color'] = $request->color;
            $data['options']['size']  = $request->size;

            Cart::add($data);  
            $notification=array(
                'messege'   =>'Add to Cart Successfully',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
    }


    // ===== Checkout =====

    public function checkout()
    {
        $setting          = DB::table('settings')->first();
        $shipping_charge  = $setting->shipping_charge;
        $vat              = $setting->vat;

        if (Auth::check()) 
        {
              $cart = Cart::content();
              return view('pages.checkout',compact('cart','shipping_charge','vat'));
        }
        else
        {
            $notification=array(
                'messege'=>'AT first login your account',
                'alert-type'=>'error'
            );
            return redirect()->route('login')->with($notification);
        }
    }

    // ======= Coupon =======
    public function coupon(Request $request)
    {
        $coupon = $request->coupon;
        
        $subtotal = Cart::Subtotal();

        $total = implode(explode(',',$subtotal)) ;  //convert into integer like- 10,500.00 to 10500

        // $result= $total - 400;
        // return number_format($result, 2);

        $check  = DB::table('coupons')->where('coupon',$coupon)->first();

        if ($check)  
        {
            Session::put('coupon',[ //take in araray
                'name'     => $check->coupon,
                'discount' => $check->discount,
                'balance'  => number_format($total - $check->discount, 2)  //convert into decimal (with comma) like- 10500 to 10,500.00 
            ]);

            // number_format($number, 2) = number_format(10500, 2) = 10,500.00
            // visit- https://www.oreilly.com/library/view/php-in-a/0596100671/re68.html

            $notification=array(
                'messege'=>'Successfully Coupon Applied',
                'alert-type'=>'success'
            );
            return redirect()->back()->with($notification);
        }
        else
        {
            $notification=array(
                'messege'=>'Invalid Coupon',
                'alert-type'=>'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    //Remove all Session Data
    public function deleteSessionData(Request $request) 
    {
        $request->session()->forget('coupon');

        $notification=array(
            'messege'   =>'Data has been removed from session.',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
        
     }

     //Remove all Cart info

    public function cartDestroy(Request $request)
    {
        Cart::destroy();
        $request->session()->forget('coupon');

        $notification  = array(
            'messege'   =>'Cart Destroy Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('front.home')->with($notification);
    }

}


//Important Element for blade
// <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
// <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">


// <script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>


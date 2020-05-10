<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Cart;

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

    public function removeCart($rowId)
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

}

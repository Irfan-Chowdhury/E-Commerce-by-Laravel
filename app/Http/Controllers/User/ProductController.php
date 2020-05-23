<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Subcategory;
use App\Model\Admin\Product;
use DB;
use Cart;

class ProductController extends Controller
{
    public function ProductView($id, $product_name)
    {
        $product = DB::table('products')
                  ->join('categories','products.category_id','categories.id')
                  ->join('subcategories','products.subcategory_id','subcategories.id')
                  ->join('brands','products.brand_id','brands.id')
                  ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                  ->where('products.id',$id)
                  ->first();

        $color         = $product->product_color;
        $product_color = explode(',', $color); //the data with comma(,) in database will be separated

        $size          = $product->product_size;
        $product_size  = explode(',', $size); //the data with comma(,) in database will be separated
          
        return  view('pages.product_details',compact('product','product_color','product_size'));
    }



    public function productAddCart(Request $request, $id)
    {
        $product = Product::find($id);
        
        $data=array();

        if ($product->discount_price == NULL) 
        {
              $data['id']     = $id;
              $data['name']   = $product->product_name;
              $data['qty']    = $request->qty;
              $data['price']  = $product->selling_price;    // Original Price      
              $data['weight'] = 1;
              $data['options']['image'] = $product->image_one;
              $data['options']['color'] = $request->color;
              $data['options']['size']  = $request->size;

              Cart::add($data);
              $notification=array(
                'messege'=>'Successfully Added',
                'alert-type'=>'success'
              );
              return Redirect()->to('/')->with($notification);
        }
        else
        {
          $data['id']     = $id;
          $data['name']   = $product->product_name;
          $data['qty']    = $request->qty;
          $data['price']  = $product->discount_price;  // Discount Price      
          $data['weight'] = 1;
          $data['options']['image'] = $product->image_one;
          $data['options']['color'] = $request->color;
          $data['options']['size']  = $request->size;
          
          Cart::add($data);  
          $notification=array(
              'messege'=>'Successfully Added',
              'alert-type'=>'success'
          );
          return Redirect()->to('/')->with($notification);
        }
    }


    // Category Wise Products Show 
    public function productsCategoryWise($id)
    {
        $products = DB::table('products')
                  ->where('category_id',$id)
                  ->paginate(30);

        $category = Category::find($id);
        
        $brands   = DB::table('products')
                  ->select('brand_id')
                  ->where('category_id',$id)
                  ->groupBy('brand_id')
                  ->get();
         
        return view('pages.products-category-wise',compact('products','category','brands'));
    }

    // Sub-Category Wise Products Show 
    public function productsSubCategoryWise($id)
    {
        $products     = DB::table('products')
                      ->where('subcategory_id',$id)
                      ->paginate(30);

        $subcategory  = DB::table('subcategories')
                      ->join('categories','categories.id','subcategories.category_id')
                      ->select('subcategories.*','categories.category_name')
                      ->where('subcategories.id',$id)
                      ->get();
        
        $brands       = DB::table('products')
                      ->select('brand_id')
                      ->where('subcategory_id',$id)
                      ->groupBy('brand_id')
                      ->get();
         
         return view('pages.products-sub-category-wise',compact('products','subcategory','brands'));
    }
}


//Important Element

// <!--Product Show -->
// <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_styles.css') }}">
// <link rel="stylesheet" type="text/css" href="{{ asset('frontend/styles/product_responsive.css') }}">

// <!-- Produc Show -->
// <script src="{{ asset('frontend/js/product_custom.js') }}"></script>

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Model\Admin\Brand;
use App\Model\Admin\Product;
use DB;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        $product=DB::table('products')
                ->join('categories','products.category_id','categories.id')
                ->join('brands','products.brand_id','brands.id')
                ->select('products.*','categories.category_name','brands.brand_name')
                ->orderBy('categories.id','DESC')
                ->get();
        return view('admin.product.index',compact('product'));
    }


    public function create()
    {
        $categories = Category::all();
    	$brands     = Brand::all();
    	return view('admin.product.create',compact('categories','brands'));
    }


    //subcategory by ajax request
    public function getSubCategory($category_id)
    {
        $cat = DB::table("subcategories")->where("category_id",$category_id)->get();
        return json_encode($cat);
    }


    public function store(Request $request)
    {
        $validatedData      = $request->validate([
            'product_name'     => 'required',
            'product_code'     => 'required',
            'product_quantity' => 'required',
            'category_id'      => 'required',
            'subcategory_id'   => 'required',
            'brand_id'         => 'required',
            'product_details'  => 'required',
            'product_color'    => 'required',
            'product_size'     => 'required',
            'selling_price'    => 'required',
        ]);

        $data  = array();
    	$data['product_name']     = $request->product_name;
    	$data['product_code']     = $request->product_code;
    	$data['product_quantity'] = $request->product_quantity;
    	$data['category_id']      = $request->category_id;
    	$data['subcategory_id']   = $request->subcategory_id;
    	$data['brand_id']         = $request->brand_id;
    	$data['product_size']     = $request->product_size;
    	$data['product_color']    = $request->product_color;
        $data['selling_price']    = $request->selling_price;
        $data['discount_price']   = $request->discount_price;
    	$data['product_details']  = $request->product_details;
    	$data['video_link']       = $request->video_link;
    	$data['main_slider']      = $request->main_slider;
    	$data['hot_deal']         = $request->hot_deal;
    	$data['best_rated']       = $request->best_rated;
    	$data['trend']            = $request->trend;
    	$data['mid_slider']       = $request->mid_slider;
    	$data['hot_new']          = $request->hot_new;
        $data['buyone_getone']    = $request->buyone_getone;
        $data['status']           = 1;
        
        $image_one  = $request->image_one;
    	$image_two  = $request->image_two;
        $image_three= $request->image_three;
        
        if($image_one && $image_two && $image_three)
        {
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(230,300)->save('public/media/product/'.$image_one_name);
            $data['image_one']='public/media/product/'.$image_one_name;

            $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(230,300)->save('public/media/product/'.$image_two_name);
            $data['image_two']='public/media/product/'.$image_two_name; 

            $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(230,300)->save('public/media/product/'.$image_three_name);
            $data['image_three']='public/media/product/'.$image_three_name; 
            
            $product = DB::table('products')->insert($data);
            $notification = array(
                'messege'=>'Successfully Product Inserted ',
                'alert-type'=>'success'
            );

            return Redirect()->back()->with($notification);   
        }
    }

    public function inactive($id)
    {
         DB::table('products')->where('id',$id)->update(['status'=> 0]);
         $notification=array(
            'messege'=>'Successfully Product Inactive ',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);  
    }

    public function active($id)
    {
         DB::table('products')->where('id',$id)->update(['status'=> 1]);
         $notification=array(
            'messege'=>'Successfully Product Aactive ',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function productDelete($id)
    {
        $product = DB::table('products')->where('id',$id)->first();
        $image1  = $product->image_one;
        $image2  = $product->image_two;
        $image3  = $product->image_three;
        unlink($image1);
        unlink($image2);
        unlink($image3);
        DB::table('products')->where('id',$id)->delete();
        $notification=array(
            'messege'=>'Successfully Product Deleted ',
            'alert-type'=>'success'
        );

        return Redirect()->back()->with($notification);
    }

    public function productView($id)
    {
        $product = DB::table('products')
                    ->join('categories','products.category_id','categories.id')
                    ->join('subcategories','products.subcategory_id','subcategories.id')
                    ->join('brands','products.brand_id','brands.id')
                    ->select('products.*','categories.category_name','subcategories.subcategory_name','brands.brand_name')
                    ->where('products.id',$id)
                    ->first();

        return view('admin.product.show',compact('product'));
    }

    public function productEdit($id)
    {
        $product = DB::table('products')->where('id',$id)->first();

        return view('admin.product.edit',compact('product'));
    }

    public function productUpdateWithoutPhoto(Request $request, $id)
    {
        $product                  = Product::find($id);
        $product->product_name    = $request->product_name;
        $product->product_code    = $request->product_code;
        $product->product_quantity= $request->product_quantity;
        $product->category_id     = $request->category_id;
        $product->discount_price  = $request->discount_price;
        $product->subcategory_id  = $request->subcategory_id;
        $product->brand_id        = $request->brand_id;
        $product->product_size    = $request->product_size;
        $product->product_color   = $request->product_color;
        $product->selling_price   = $request->selling_price;
        $product->product_details = $request->product_details;
        $product->video_link      = $request->video_link;
        $product->main_slider     = $request->main_slider;
        $product->hot_deal        = $request->hot_deal;
        $product->best_rated      = $request->best_rated;
        $product->trend           = $request->trend;
        $product->mid_slider      = $request->mid_slider;
        $product->hot_new         = $request->hot_new;
        $product->buyone_getone   = $request->buyone_getone;

        $update = $product->update();
        
        if ($update) 
        {
             $notification=array(
                'messege'=>'Successfully Product Updated ',
                'alert-type'=>'success'
            );

            return Redirect()->route('product.index')->with($notification);
        }
        else
        {
            $notification=array(
                'messege'=>'Nothing To Updated ',
                'alert-type'=>'success'
            );

            return Redirect()->route('product.index')->with($notification);
        }
    }

    public function productPhotoUpdate(Request $request, $id)
    {
        $old_one     = $request->old_one;
        $old_two     = $request->old_two;
        $old_three   = $request->old_three;

        $image_one   = $request->image_one;
        $image_two   = $request->image_two;
        $image_three = $request->image_three;

        $data = array();

        // ============ For Triple Image Together =========

        if($request->has('image_one') && $request->has('image_two') && $request->has('image_three'))
        {
            unlink($old_one);
            unlink($old_two);
            unlink($old_three);

            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(230,300)->save('public/media/product/'.$image_one_name);
            $data['image_one']='public/media/product/'.$image_one_name;
                
            $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(230,300)->save('public/media/product/'.$image_two_name);
            $data['image_two']='public/media/product/'.$image_two_name;

            $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(230,300)->save('public/media/product/'.$image_three_name);
            $data['image_three']='public/media/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);

            $notification=array(
                'messege'=>'Image One and Two Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.index')->with($notification);
        }

    
        // ============ For Double Image Together =========

        if($request->has('image_one') && $request->has('image_two'))
        {
            unlink($old_one);
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(230,300)->save('public/media/product/'.$image_one_name);
            $data['image_one']='public/media/product/'.$image_one_name;
                
            unlink($old_two); 
            $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(230,300)->save('public/media/product/'.$image_two_name);
            $data['image_two']='public/media/product/'.$image_two_name;

            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image One and Two Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.index')->with($notification);
        }
        elseif ($request->has('image_two') && $request->has('image_three')) 
        {
            unlink($old_two); 
            $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(230,300)->save('public/media/product/'.$image_two_name);
            $data['image_two']='public/media/product/'.$image_two_name;

            unlink($old_three);
            $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(230,300)->save('public/media/product/'.$image_three_name);
            $data['image_three']='public/media/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);

            $notification=array(
                'messege'=>'Image One and Two Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.index')->with($notification);
        }
        elseif ($request->has('image_one') && $request->has('image_three')) 
        {
            unlink($old_one);
            $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(230,300)->save('public/media/product/'.$image_one_name);
            $data['image_one']='public/media/product/'.$image_one_name;

            unlink($old_three);
            $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(230,300)->save('public/media/product/'.$image_three_name);
            $data['image_three']='public/media/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);

            $notification=array(
                'messege'=>'Image One and Two Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.index')->with($notification);
        }


        // ============ For Single Image =========
        
        if($request->has('image_one')) 
        {
            unlink($old_one);
            $image_one_name = hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300,300)->save('public/media/product/'.$image_one_name);
            $data['image_one']='public/media/product/'.$image_one_name;
            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image One Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.index')->with($notification);
        }
        elseif($request->has('image_two')) 
        {
            unlink($old_two);
            $image_two_name= hexdec(uniqid()).'.'.$image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(230,300)->save('public/media/product/'.$image_two_name);
            $data['image_two']='public/media/product/'.$image_two_name;
            DB::table('products')->where('id',$id)->update($data);
            $notification=array(
                'messege'=>'Image Two Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.index')->with($notification);
        }
        elseif($request->has('image_three')) 
        {
            unlink($old_three);
            $image_three_name= hexdec(uniqid()).'.'.$image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(230,300)->save('public/media/product/'.$image_three_name);
            $data['image_three']='public/media/product/'.$image_three_name;

            DB::table('products')->where('id',$id)->update($data);

            $notification=array(
                'messege'=>'Image Three Updated ',
                'alert-type'=>'success'
            );
            return Redirect()->route('product.index')->with($notification);
        }
    }
}



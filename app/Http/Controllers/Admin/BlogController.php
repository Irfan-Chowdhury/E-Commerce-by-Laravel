<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\PostCategory;
use App\Model\Admin\Post;
use DB;
use Image;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    /**************************************************************************************
    *                                                                                     *
    *                  C A T E G O R Y       of       P O S T                             *
    *                                                                                     *
    **************************************************************************************/


    public function categoryIndex()
    {
        $PostCategories = PostCategory::all();

        return view('admin.blog.category.index',compact('PostCategories'));
    }

    public function categoryStore(Request $request)
    {
        $validatedData = $request->validate([
            'category_name_en' => 'required|unique:post_categories|max:55',
            'category_name_bn' => 'required|unique:post_categories|max:55',
            ]);

        $postCategory = new PostCategory();
        $postCategory->category_name_en = $request->category_name_en;
        $postCategory->category_name_bn = $request->category_name_bn;
        $postCategory->save();

        $notification= array(
            'messege'=>'Category Insert Done',
            'alert-type'=>'success'
        );

        return redirect()->back()->with($notification);
    }



    public function categoryDestroy($id) 
    {
        $postCategory = PostCategory::find($id);

        if ($postCategory->posts()->count() ) //For Database Relationship Maintain
        {
            $notification = array(
                'messege'   =>'This Parent row has Child records',
                'alert-type'=>'error'
            );
            return Redirect()->back()->with($notification);
        }

        $postCategory->delete();

        $notification = array(
            'messege'=>'Category Successfully Deleted',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);    	
    }

    public function categoryEdit($id)
    {
        $postCategory = PostCategory::find($id);

    	return view('admin.blog.category.edit',compact('postCategory'));
    }


    public function categoryUpdate(Request $request,$id)
    {
        $validatedData = $request->validate([
            'category_name_en' => 'required',
            'category_name_bn' => 'required',
        ]);

        $postCategory = PostCategory::find($id);
        $postCategory->category_name_en = $request->category_name_en;
        $postCategory->category_name_bn = $request->category_name_bn;
        $update = $postCategory->update();

        $notification=array(
            'messege'=>'Category Successfully Updated',
            'alert-type'=>'success'
        );

        return Redirect()->route('blog.category.index')->with($notification);
    }
    
    
    
    
    /**************************************************************************************
    *                                                                                     *
    *                    ----    P O S T         P A R T    ----                          *
    *                                                                                     *
    **************************************************************************************/


    public function index()
    {
        $post=DB::table('posts')->join('post_categories','posts.post_category_id','post_categories.id')
              ->select('posts.*','post_categories.category_name_en')->get();

              
    	return view('admin.blog.post.index',compact('post'));      
    }
    public function create()
    {
        $post_categories = PostCategory::all();

    	//return response()->json($category);
    	return view('admin.blog.post.create',compact('post_categories'));
    }

    public function store(Request $request)
    {
        $validatedData   = $request->validate([
            'post_title_en'    => 'required',
            'post_title_bn'    => 'required',
            'post_category_id' => 'required',
            'details_en'       => 'required',
            'details_bn'       => 'required',
            'post_image'       => 'required',
        ]);

        $data   = array();
    	$data['post_title_en'] = $request->post_title_en;
    	$data['post_title_bn'] = $request->post_title_bn;
    	$data['post_category_id']   = $request->post_category_id;
    	$data['details_en']    = $request->details_en;
    	$data['details_bn']    = $request->details_bn;

        $post_image = $request->file('post_image'); 
        
        if ($post_image) 
        {
            $image_one_name= hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,240)->save('public/media/post/'.$image_one_name);
            $data['post_image']='public/media/post/'.$image_one_name;

            DB::table('posts')->insert($data);

            $notification=array(
                'messege'=>'Successfully Post Inserted ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);
        }
        else
        {
    		$data['post_image'] = '';
            DB::table('posts')->insert($data);
            $notification=array(
                'messege'=>'Successfully Post Inserted ',
                'alert-type'=>'success'
            );
            return Redirect()->back()->with($notification);	
    	}
    }

    public function destroy($id)
    {
        $post  = DB::table('posts')->where('id',$id)->first();
    	$image = $post->post_image;
    	unlink($image);
        DB::table('posts')->where('id',$id)->delete();
        
    	$notification=array(
            'messege'=>'Successfully Post Deleted ',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function edit($id)
    {
        $post            = Post::find($id);
        $post_categories = PostCategory::all();

    	return view('admin.blog.post.edit',compact('post','post_categories'));
    }


    public function update(Request $request, $id)
    {
        $oldimage = $request->old_image;
        
        $data = Post::find($id);
        
        $data->post_title_en    = $request->post_title_en;
        $data->post_title_bn    = $request->post_title_bn;
        $data->post_category_id = $request->post_category_id;
        $data->details_en       = $request->details_en;
        $data->details_bn       = $request->details_bn;
        
        $post_image = $request->file('post_image');
        
        if ($post_image) {
            unlink($oldimage);
            $image_one_name= hexdec(uniqid()).'.'.$post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400,240)->save('public/media/post/'.$image_one_name);
            
            $data->post_image = 'public/media/post/'.$image_one_name;
            $data->update();

            $notification=array(
                'messege'=>'Successfully Post Update ',
                'alert-type'=>'success'
            );
            return Redirect()->route('blog.post.index')->with($notification);
        }
        else
        {
            $data->post_image = $oldimage;
            $data->update();

            $notification=array(
                'messege'=>'Successfully Post Update ',
                'alert-type'=>'success'
            );
            return Redirect()->route('blog.post.index')->with($notification);	
        }
    }
}

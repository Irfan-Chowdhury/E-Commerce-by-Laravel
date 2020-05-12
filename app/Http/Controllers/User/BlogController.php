<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Model\Admin\Post;

class BlogController extends Controller
{
    public function blog()
    {
        $posts = Post::all();
        
        return view('pages.blog',compact('posts'));
    }


    public function singlePost($id)
    {
        $post = DB::table('posts')
                ->select('posts.*','post_categories.category_name_en','post_categories.category_name_bn')
                ->join('post_categories','posts.post_category_id','post_categories.id')
                ->where('posts.id',$id)
                ->first();

        $all_post = Post::all();

        return view('pages.blog_single_post',compact('post','all_post'));
    }

}

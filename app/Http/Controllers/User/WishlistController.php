<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class WishlistController extends Controller
{
    // public function wishlistAdd($id)
    // {
    //     $userid = Auth::id();
    //     $check  = DB::table('wishlists')->where('user_id',$userid)->where('product_id',$id)->first();
                            
    // 	$data = array(
    // 		'user_id'   => $userid, 
    // 		'product_id'=> $id 
    // 	);

    //     if (Auth::check()) 
    //     {
    //         if ($check) 
    //         {
    // 			$notification=array(
    //                 'messege'=>'Product Already has on your wishlist',
    //                 'alert-type'=>'error'
    //             );
    //             return Redirect()->back()->with($notification); 
    //         }
    //         else
    //         {
    // 			DB::table('wishlists')->insert($data);
    //             $notification=array(
    //                 'messege'   =>'Successfully Added on your wishlist',
    //                 'alert-type'=>'success'
    //             );
    //             return Redirect()->back()->with($notification); 
    //         } 	
    //     }
    //     else
    //     {
    // 		$notification=array(
    //             'messege'   =>'At First Login Your Account',
    //             'alert-type'=>'warning'
    //         );
    //         return Redirect()->back()->with($notification); 
    // 	}
    // }


    public function wishlistAdd($id)
    {
        $userid = Auth::id();
    	$check  = DB::table('wishlists')->where('user_id',$userid)->where('product_id',$id)->first();

    	$data = array(
    		'user_id'   => $userid, 
    		'product_id'=>$id 
    	);

        if (Auth::check()) 
        {
            if ($check) 
            {
    			// return \Response::json(['error' => 'Product Already has on your wishlist']);        
                return response()->json(['error' => 'Product Already has on your wishlist']);       
            }
            else
            {
    			DB::table('wishlists')->insert($data);
                //   return \Response::json(['success' => 'Successfully Added on your wishlist']); 
                return response()->json(['success' => 'Successfully Added on your wishlist']);   		
    		}
        }
        else
        {
    		//return \Response::json(['error' => 'At first login your account']);
              return response()->json(['error' => 'At first login your account']);        
    	}
    }
}





//Ajax Wishlist importtant Element


// <link rel="stylesheet" href="sweetalert2.min.css">  //goto- app.blade.php
// <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> //goto- index.blade.php
// <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script> //goto- app.blade.php



//goto- index.blade.php 

// <script type="text/javascript">
// $(document).ready(function() {
//       $('.addwishlist').on('click', function(){  
//         var id = $(this).data('id');
//         // alert(id);

//         if(id) {
//            $.ajax({
//                url: "{{  url('/wishlist/add/') }}/"+id,
//                type:"GET",
//                dataType:"json",
//                success:function(data) {
//                  const Toast = Swal.mixin({
//                     toast: true,
//                     position: 'top-end',
//                     showConfirmButton: false,
//                     timer: 3000
//                   })

//                  if($.isEmptyObject(data.error)){
//                       Toast.fire({
//                         type: 'success',
//                         title: data.success
//                       })
//                  }else{
//                        Toast.fire({
//                           type: 'error',
//                           title: data.error
//                       })
//                  }

//                },
              
//            });
//        } else {
//            alert('danger');
//        }
//         e.preventDefault();
//    });
// });

// </script>


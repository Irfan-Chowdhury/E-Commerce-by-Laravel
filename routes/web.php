<?php


// Route::get('/', function(){
//     return view('pages.index');
// });


            //-------auth & user----------
Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');


            //-------admin---------------
Route::get('/admin/home', 'AdminController@index');
Route::get('/admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin', 'Admin\LoginController@login');

            //-------Password Reset Routes------------
Route::get('/admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('/admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('/admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('/admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password','AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update','AdminController@Update_pass')->name('admin.password.update');
Route::get('/admin/logout', 'AdminController@logout')->name('admin.logout');

        //======================= Admin ===========================

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    //--Categoy--
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/','CategoryController@category')->name('categories');
        Route::post('store/category', 'CategoryController@storeCatgory')->name('store.category'); //video- @storecatgory
        Route::get('delete/category/{id}','CategoryController@deleteCategory');
        Route::get('edit/category/{id}','CategoryController@editCategory');
        Route::post('update/category/{id}','CategoryController@updateCategory');
    });
    
    //--Subcategory--
    Route::group(['prefix' => 'subcategory'], function () {
        Route::get('/', 'SubCategoryController@subCategory')->name('subcategory');
        Route::post('store', 'SubCategoryController@subCategoryStore')->name('subcategory.store'); 
        Route::get('delete/{id}','SubCategoryController@subCategoryDelete')->name('subcategory.delete');
        Route::get('edit/{id}','SubCategoryController@subCategoryEdit')->name('subcategory.edit');
        Route::post('update/{id}','SubCategoryController@subCategoryUpdate')->name('subcategory.update');
    });
    
    //--Brand--
    Route::group(['prefix' => 'brand'], function () {
        Route::get('/', 'BrandController@brand')->name('brand');
        Route::post('store', 'BrandController@brandStore')->name('brand.store'); 
        Route::get('delete/{id}','BrandController@brandDelete')->name('brand.delete'); 
        Route::get('edit/{id}','BrandController@brandEdit')->name('brand.edit');
        Route::post('update/{id}','BrandController@brandUpdate')->name('brand.update');
    });
    
    //--Coupon--
    Route::group(['prefix' => 'coupon'], function () {
        Route::get('/', 'CouponController@coupon')->name('coupon');
        Route::post('store', 'CouponController@couponStore')->name('coupon.store'); 
        Route::get('delete/{id}','CouponController@couponDelete')->name('coupon.delete'); 
        Route::get('edit/{id}','CouponController@couponEdit')->name('coupon.edit');
        Route::post('update/{id}','CouponController@couponUpdate')->name('coupon.update');
    });

    //--Newslater--
    Route::group(['prefix' => 'newslater'], function () {
        Route::get('/','NewslaterController@newslater')->name('newslater');
        Route::get('/delete/{id}','NewslaterController@newslaterDelete')->name('newslater.delete');  
    });
    
    //--Products--
    Route::group(['prefix' => 'product'], function () {
        Route::get('/', 'ProductController@index')->name('product.index'); //there- all.product
        Route::get('/create', 'ProductController@create')->name('product.create'); //there- add.product
        //get Sub-Category by ajax
        Route::get('get/subcategory/{category_id}','ProductController@getSubCategory'); //Ajax
        Route::post('/store', 'ProductController@store')->name('product.store');
        Route::get('inactive/{id}','ProductController@inactive')->name('product.inactive'); 
        Route::get('active/{id}','ProductController@active')->name('product.active');   
        Route::get('delete/{id}','ProductController@productDelete')->name('product.delete');
        Route::get('view/{id}','ProductController@productView')->name('product.view');
        Route::get('edit/{id}','ProductController@productEdit')->name('product.edit');
        Route::post('update/withoutphoto/{id}','ProductController@productUpdateWithoutPhoto')->name('product.update.without_photo');
        Route::post('update/photo/{id}','ProductController@productPhotoUpdate')->name('product.update.photo');  
    });

    //--Blog--
    Route::group(['prefix' => 'blog'], function () {
        //Category of Post
        Route::get('/category/index', 'BlogController@categoryIndex')->name('blog.category.index');
        Route::post('/category/store', 'BlogController@categoryStore')->name('blog.category.store');
        Route::get('/category/destroy/{id}','BlogController@categoryDestroy')->name('blog.category.destroy');
        Route::get('/category/edit/{id}','BlogController@categoryEdit')->name('blog.category.edit');
        Route::post('/category/update/{id}','BlogController@categoryUpdate')->name('blog.category.update');
        //Post
        Route::get('/post/index', 'BlogController@index')->name('blog.post.index');
        Route::get('/post/create', 'BlogController@create')->name('blog.post.create');
        Route::post('/post/store', 'BlogController@store')->name('blog.post.store');
        Route::get('/post/destroy/{id}','BlogController@destroy')->name('blog.post.destroy');
        Route::get('/post/edit/{id}','BlogController@edit')->name('blog.post.edit');
        Route::post('/post/update/{id}','BlogController@update')->name('blog.post.update');
    });

});


// ========= Frontend part all in here =========

Route::group(['namespace' => 'User'], function () {
    Route::get('/', 'FrontController@index')->name('front.home');
    Route::post('newslater/store', 'FrontController@newslaterStore')->name('newslater.store');

    //--Wishlist--
    Route::group(['prefix' => '/wishlist'], function () { 
        Route::get('/add/{id}', 'WishlistController@wishlistAdd')->name('wishlist.add'); //Ajax use
        Route::get('/user/show','WishlistController@wishlistShow')->name('wishlist.show'); //there user.wishlist
        Route::get('/delete/{id}', 'WishlistController@wishlistDelete')->name('wishlist.delete'); //Ajax use
    });
   

    //--Cart--
    Route::group(['prefix' => '/cart'], function () { 
        Route::get('/to/add/{id}', 'CartController@cartAdd')->name('cart.add'); //Ajax use
        Route::get('/check', 'CartController@check');
        Route::get('/product/show','CartController@showCart')->name('show.cart');
        Route::get('/remove/{rowId}','CartController@removeCart')->name('remove.cart');        
        Route::post('/update/item/{rowId}','CartController@updateCart')->name('update.cartitem');
        //In Modal from Front
        Route::get('/product/view/{id}','CartController@viewProduct'); //Ajax
        Route::post('/insert-into-cart','CartController@insertIntoCart')->name('insert.into.cart');
        Route::get('/user/checkout/','CartController@checkout')->name('user.checkout');

    });


    //--Socialite--
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');
   
    // --- Product Details Show ---
    Route::group(['prefix' => 'product'], function () {
        Route::get('/details/{id}/{product_name}', 'ProductController@ProductView');
        Route::post('/add/cart/{id}', 'ProductController@productAddCart')->name('product.add.cart');

    });   
    

});




// php artisan make:migration create_users_table --create=users


// ---- Package ----
// 1. Image Intervention : http://image.intervention.io/
// 2. Shopping Cart      : https://packagist.org/packages/bumbummen99/shoppingcart
// 3. Socialite          : https://www.tutsmake.com/laravel-6-google-login-tutorial-with-socialite-demo-example/

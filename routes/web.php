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


    Route::group(['prefix' => '/'], function () {
        //--Newslater--
        Route::get('/newslater','OtherController@newslater')->name('newslater');
        Route::get('/newslater/delete/{id}','OtherController@newslaterDelete')->name('newslater.delete');  
        //--SEO--
        Route::get('/seo', 'OtherController@seo')->name('seo');
        Route::post('/seo/update/{id}', 'OtherController@seoUpdate')->name('seo.update');
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


    Route::group(['prefix' => 'order'], function () {
        Route::get('new', 'OrderController@orderNew')->name('order.new');
        Route::get('view/{id}', 'OrderController@orderView')->name('order.view');
        Route::get('payment/accept/{id}', 'OrderController@orderPaymentAccept')->name('order.payment.accept');
        Route::get('/payment/accept-list', 'OrderController@orderPaymentAcceptList')->name('order.payment.accept.list'); 
        Route::get('delivery/progress/{id}', 'OrderController@orderDeliveryProgress')->name('order.delivery.progress');
        Route::get('delivery/progress-list', 'OrderController@orderDeliveryProgressList')->name('order.delivery.progress.list');
        Route::get('delivery/done/{id}', 'OrderController@orderDeliveryDone')->name('order.delivery.done');
        Route::get('delivery/success-list', 'OrderController@orderDeliverySuccessList')->name('order.delivery.success.list');
        Route::get('payment/cancel/{id}', 'OrderController@orderPaymentCancel')->name('order.payment.cancel');
        Route::get('payment/cancel-list', 'OrderController@orderPaymentCancelList')->name('order.payment.cancel.list'); 
    });


    //Reports
    Route::group(['prefix' => 'report'], function () {
        Route::get('today/order', 'ReportController@todayOrder')->name('today.order');
        Route::get('today/deleverd', 'ReportController@todayDelevered')->name('today.delevered');
        Route::get('this/month', 'ReportController@thisMonth')->name('this.month');
        Route::get('search/report', 'ReportController@search')->name('search.report');
        Route::post('search/by-date', 'ReportController@searchByDate')->name('search.by-date');
        Route::post('search/by-month', 'ReportController@searchByMonth')->name('search.by-month');
        Route::post('search/by-year', 'ReportController@searchByYear')->name('search.by-year');
    });


    Route::group(['prefix' => 'sub-admin'], function () {
        Route::get('all', 'SubAdminController@subAdminAll')->name('sub-admin.all');
        Route::get('create', 'SubAdminController@subAdminCreate')->name('sub-admin.create');
        Route::post('store', 'SubAdminController@subAdminStore')->name('sub-admin.store');
        Route::get('delete/{id}', 'SubAdminController@subAdminDelete')->name('sub-admin.delete');
        Route::get('edit/{id}', 'SubAdminController@subAdminEdit')->name('sub-admin.edit');
        Route::post('update/{id}', 'SubAdminController@subAdminUpdate')->name('sub-admin.update');
    });

    //site setting
    Route::group(['prefix' => 'site/setting'], function () {
        Route::get('/', 'SiteSettingController@siteSetting')->name('site.setting');
        Route::post('update/{id}', 'SiteSettingController@siteSettingUpdate')->name('site.setting.update');
    });
    


});


// ========= Frontend part all in here =========

Route::group(['namespace' => 'User'], function () {
    Route::get('/', 'FrontController@index')->name('front.home');
    Route::post('newslater/store', 'FrontController@newslaterStore')->name('newslater.store');
    Route::post('order/tracking', 'FrontController@orderTracking')->name('order.tracking');


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
        Route::get('/remove/{rowId}','CartController@removeCartById')->name('remove.cart');        
        Route::post('/update/item/{rowId}','CartController@updateCart')->name('update.cartitem');
        //In Modal from Front
        Route::get('/product/view/{id}','CartController@viewProduct'); //Ajax
        Route::post('/insert-into-cart','CartController@insertIntoCart')->name('insert.into.cart');
        Route::get('/user/checkout/','CartController@checkout')->name('user.checkout');
        Route::post('/user/apply/coupon/','CartController@coupon')->name('apply.coupon');
        //Remove all Session Data
        Route::get('/session/remove','CartController@deleteSessionData')->name('session.remove');
        //Remove all Cart Data
        Route::get('/destroy','CartController@cartDestroy')->name('cart.destroy');
    });


    // --- Payment ----
    Route::group(['prefix' => 'payment'], function () { 
        Route::get('page','PaymentController@paymentPage')->name('payment.step');
        Route::post('/process','PaymentController@paymentProcess')->name('payment.process');
        Route::post('/stripe/charge/','PaymentController@stripeCharge')->name('payment.stripe.charge');

    });


    //--Socialite--
    Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
    Route::get('/callback/{provider}', 'SocialController@callback');
   
    // --- Product Details Show ---
    Route::group(['prefix' => 'product'], function () {
        Route::get('/details/{id}/{product_name}', 'ProductController@ProductView');
        Route::post('/add/cart/{id}', 'ProductController@productAddCart')->name('product.add.cart');

    });   

    //--- Language Control ---
    Route::group(['prefix' => 'language'], function () {
        Route::get('/bangla','LanguageController@Bangla')->name('language.bangla');
        Route::get('/english','LanguageController@English')->name('language.english');
    });
    
    //--- User Blog ---
    Route::group(['prefix' => 'blog'], function () {
        Route::get('/post','BlogController@blog')->name('blog.post');
        Route::get('/single_post/{id}','BlogController@singlePost')->name('blog.single_post');
    });       

});




// php artisan make:migration create_users_table --create=users


// ---- Package ----
// 1. Image Intervention : http://image.intervention.io/
// 2. Shopping Cart      : https://packagist.org/packages/bumbummen99/shoppingcart
// 3. Socialite          : https://www.tutsmake.com/laravel-6-google-login-tutorial-with-socialite-demo-example/
// 4. "Stripe" Payment Gateway : https://stripe.com/docs/libraries
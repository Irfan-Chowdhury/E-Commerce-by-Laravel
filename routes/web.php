<?php


Route::get('/', function(){
    return view('pages.index');
});


            //-------auth & user----------
Auth::routes();
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
    });
    
});




// ========= Frontend part all in here =========

Route::group(['namespace' => 'User'], function () {
    Route::post('newslater/store', 'FrontController@newslaterStore')->name('newslater.store');
});



// php artisan make:migration create_users_table --create=users





// Route::post('/store', 'ProductController@store')->name('product.store');
// Route::get('inactive/product/{id}','ProductController@Inactive'); 
// Route::get('active/product/{id}','ProductController@Active');
// Route::get('delete/product/{id}','ProductController@DeleteProduct');
// Route::get('view/product/{id}','ProductController@ViewProduct');
// Route::get('edit/product/{id}','ProductController@EditProduct');
// Route::post('update/product/withoutphoto/{id}','ProductController@UpdateProductWithoutPhoto');
// Route::post('update/product/photo/{id}','ProductController@UpdateProductPhoto');  
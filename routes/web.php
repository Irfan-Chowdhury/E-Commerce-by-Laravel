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

//--Categoy--
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    
    Route::group(['namespace' => 'Category'], function () {
        Route::get('categories','CategoryController@category')->name('categories');
        Route::post('store/category', 'CategoryController@storeCatgory')->name('store.category'); //video- @storecatgory
        Route::get('delete/category/{id}','CategoryController@deleteCategory');
        Route::get('edit/category/{id}','CategoryController@editCategory');
        Route::post('update/category/{id}','CategoryController@updateCategory');
    });

    //--brands--
    Route::group(['prefix' => 'brand','namespace' => 'Brand'], function () {
        Route::get('/', 'BrandController@brand')->name('brand');
        Route::post('store', 'BrandController@brandStore')->name('brand.store'); 
        Route::get('delete/{id}','BrandController@brandDelete')->name('brand.delete'); ;
        Route::get('edit/{id}','BrandController@brandEdit')->name('brand.edit'); ; 
        Route::post('update/{id}','BrandController@brandUpdate')->name('brand.update'); ; 
    });


});
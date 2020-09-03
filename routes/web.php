<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['prefix' => 'admin'] ,function (){
    Route::get('home',function (){
        return view('admin/homepage');
    })->name('admin.homepage');
    Route::get('edit','Admin\AdminController@edit')->name('admin.edit');
    Route::group(['prefix' => 'quankho'],function (){
        Route::get('/','Admin\UsersController@viewUsers')->name('quankho.view');
        Route::get('add','Admin\UsersController@addUsers')->name('quankho.add');
        Route::post('add','Admin\UsersController@insertUsers');
        Route::get('delete/{id}','Admin\UsersController@deleteUsers')->name('quankho.delete');
        Route::get('edit/{id}','Admin\UsersController@editUsers')->name('quankho.edit');
        Route::post('edit/{id}','Admin\UsersController@updateUsers')->name('quankho.update');
        Route::get('export','Admin\ExportController@export')->name('quankho.export');
        Route::post('resetPassword','Admin\UsersController@updatePassword')->name('quankho.resetPassword');
//        Route::post('resetPassword/update','Admin\UsersController@updatePassword')->name('quankho.updatePassword');
    });
    Route::group(['prefix' => 'kho'],function(){
        Route::get('/','Admin\StockController@viewStock')->name('kho.view');
        Route::get('getquankho','Admin\StockController@getUser')->name('kho.getUser');
        Route::post('/','Admin\StockController@addStock')->name('kho.add');
    });
});
Route::group(['prefix' => 'users'],function (){
    Route::get('/{id}','Users\ProductController@homepage')->name('user.homepage');
    Route::get('{stock}/{id}','Users\ProductController@index')->name('product.index');
    Route::get('export/{id}/{user_id}','Users\ExportController@export')->name('product.export');
    Route::get('add/{stock}/{id}','Users\ProductController@add')->name('product.add');
    Route::post('add/{stock}/{id}','Users\ProductController@insertProduct')->name('product.insert');
    Route::get('delete/{stock}/{user_id}/{id}','Users\ProductController@deleteProduct')->name('product.delete');
    Route::get('edit/{stock}/{user_id}/{id}','Users\ProductController@editProduct')->name('product.edit');
    Route::post('update','Users\ProductController@updateProduct')->name('product.update');
});
Route::post('/','Auth\LoginController@authenticate')->middleware('checkAdmin');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/', function () {
    return view('login');
})->name('login');
Route::get('/reset_password',function(){
   return view('resetPassword');
})->name('reset_password');
Route::post('reset_password','ResetPasswordController@sendMail');
Route::get('change_password/{token}','ResetPasswordController@resetView');
Route::post('change_password/{token}','ResetPasswordController@reset');

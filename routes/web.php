<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
// use App\Http\Controllers\Admin\HomeController;
// use App\Http\Controllers\Client\ClientController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', ['name' => 'formlogin', 'uses' => 'Auth\AuthController@formlogin'])->name('formlogin');
Route::post('login', ['name' => 'login', 'uses' => 'Auth\AuthController@login'])->name('login');
Route::get('register', ['name' => 'formregister', 'uses' => 'Auth\AuthController@formregister'])->name('formregister');
Route::post('register', ['name' => 'register', 'uses' => 'Auth\AuthController@register'])->name('register');
Route::group(['middleware' => ['auth']], function () {
    Route::get('logout', ['name' => 'logout', 'uses' => 'Auth\AuthController@logout'])->name('logout');
    Route::get('/email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify')->middleware(['signed']);
    Route::post('/email/resend', 'VerificationController@resend')->name('verification.resend');
});


Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['verified']], function () {
        Route::group(['middleware' => 'checklogin'], function () {
            Route::group(['prefix' => 'amin', 'as' => 'admin.'], function () {
                Route::get('/', ['name' => 'index', 'uses' => 'Admin\HomeController@index'])->name('index');
                Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
                    Route::get('', ['name' => 'list', 'uses' => 'Admin\ProductController@list'])->name('list');
                    Route::get('add-product', ['name' => 'add', 'uses' => 'Admin\ProductController@add'])->name('add');
                    Route::post('insert-product', ['name' => 'insert', 'uses' => 'Admin\ProductController@insert'])->name('insert');
                    Route::get('edit-product/{id}', ['name' => 'edit', 'uses' => 'Admin\ProductController@edit'])->name('edit');
                    Route::put('update-product/{id}', ['name' => 'update', 'uses' => 'Admin\ProductController@update'])->name('update');
                    Route::get('delete-product/{id}', ['name' => 'delete', 'uses' => 'Admin\ProductController@delete'])->name('delete');
                });

                Route::group(['prefix'=>'category', 'as'=>'category.'], function(){
                    Route::get('', ['name'=>'list', 'uses'=>'Admin\CategoryController@list'])->name('list');
                    Route::get('add-category', ['name'=>'add', 'uses'=>'Admin\CategoryController@add'])->name('add');
                    Route::post('insert-category', ['name'=>'insert', 'uses'=>'Admin\CategoryController@insert'])->name('insert');
                    Route::get('edit-category/{id}', ['name'=>'edit', 'uses'=>'Admin\CategoryController@edit'])->name('edit');
                    Route::put('update-category/{id}', ['name'=>'update', 'uses'=>'Admin\CategoryController@update'])->name('update');
                    Route::get('delete-category/{id}', ['name'=>'delete', 'uses'=>'Admin\CategoryController@delete'])->name('delete');
                });
                Route::group(['prefix'=>'user', 'middleware'=>['auth'],'as'=>'user.'], function () {
                    Route::get('', ['name'=>'list', 'uses'=>'User\UserController@list'])->name('list');
                    Route::get('edit-user/{id}', ['name'=>'edit', 'uses'=>'User\UserController@edit'])->name('edit');
                    Route::put('update-user/{id}', ['name'=>'update', 'uses'=>'User\UserController@update'])->name('update');
                    Route::get('delete-user/{id}', ['name'=>'delete', 'uses'=>'User\UserController@delete'])->name('delete');
                });
            });
        });
    });
});

Route::group(['prefix' => 'client', 'as' => 'client.'], function () {
    Route::get('/', ['as' => 'index', 'uses' => 'Client\ClientController@index']);
    Route::get('detail/{id}', ['as' => 'detail', 'uses' => 'Client\DetailController@index']);
    Route::post('add-cart', ['as' => 'addCart', 'uses' => 'Client\CartController@add_cart']);
    Route::group( ['middleware' => ['auth']], function(){
        Route::get('cart', ['as' => 'cart', 'uses' => 'Client\CartController@cart']);
        Route::get('delete-cart/{session_id}', ['as' => 'deletecart', 'uses' => 'CartController@delete_cart']);
        Route::post('order-detail', ['as'=>'orderdetail', 'uses'=>'Client\CartController@order_detail']);
        Route::get('vnpay-payment', ['as'=>'vnpaypayment', 'uses'=>'Client\CartController@payment']);
    });
});

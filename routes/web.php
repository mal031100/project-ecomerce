<?php

use Illuminate\Support\Facades\Route;
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
Route::group(['prefix'=>'', 'as'=>'account.'], function(){
    Route::get('', ['name'=>'formlogin', 'uses'=>'Auth\AuthController@formlogin'])->name('formlogin');
    Route::post('login', ['name'=>'login', 'uses'=>'Auth\AuthController@login'])->name('login');
    Route::get('register', ['name'=>'formregister', 'uses'=>'Auth\AuthController@formregister'])->name('formregister');
    Route::post('register', ['name'=>'register', 'uses'=>'Auth\AuthController@register'])->name('register');
    Route::get('logout', ['name'=>'logout', 'uses'=>'Auth\AuthController@logout'])->name('logout');

    Route::get('list', ['name'=>'list', 'uses'=>'Auth\AuthController@list'])->name('list');
});

Route::group(['prefix'=>'amin', 'as'=>'admin.'], function(){
    Route::get('/', ['name'=>'index', 'uses' => 'Admin\HomeController@index'])->name('index');
    Route::group(['prefix'=>'product', 'as'=>'product.'], function(){
        Route::get('',['name'=>'list', 'uses'=>'Admin\ProductController@list'])->name('list');
        Route::get('add-product',['name'=>'add', 'uses'=>'Admin\ProductController@add'])->name('add');
        Route::post('insert-product', ['name'=>'insert', 'uses'=>'Admin\ProductController@insert'])->name('insert');
        Route::get('edit-product/{id}',['name'=>'edit', 'uses'=>'Admin\ProductController@edit'])->name('edit');
        Route::put('update-product/{id}',['name'=>'update', 'uses'=>'Admin\ProductController@update'])->name('update');
        Route::get('delete-product/{id}', ['name'=>'delete', 'uses'=>'Admin\ProductController@delete'])->name('delete');
    });
});

Route::group(['prefix'=>'client', 'as'=>'client.'], function(){
    Route::get('/', ['as'=>'index', 'uses' => 'Client\ClientController@index']);
});
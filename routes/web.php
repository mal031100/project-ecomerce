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

// Route::prefix('amin')->group(function(){
//     Route::get('/', [HomeController::class, 'index'])->name('admin.index');
// });

// Route::prefix('client')->group(function(){
//     Route::get('/', [ClientController::class, 'index'])->name('client.index');
// });

Route::group(['prefix'=>'amin', 'as'=>'admin.'], function(){
    Route::get('/', ['as'=>'index', 'uses' => 'Admin\HomeController@index']);
    Route::group(['prefix'=>'product', 'as'=>'product.'], function(){
        Route::get('',['name'=>'list', 'uses'=>'Admin\ProductController@list']);
        Route::get('add-product',['name'=>'add', 'uses'=>'Admin\ProductController@add']);
        Route::post('insert-product', ['name'=>'insert', 'uses'=>'Admin\ProductController@insert']);
        Route::get('edit-product/{id}',['name'=>'edit', 'uses'=>'Admin\ProductController@edit']);
        Route::put('update-product/{id}',['name'=>'update', 'uses'=>'Admin\ProductController@update']);
        Route::get('delete-product/{id}', ['name'=>'delete', 'uses'=>'Admin\ProductController@delete']);
    });
});

Route::group(['prefix'=>'client', 'as'=>'client.'], function(){
    Route::get('/', ['as'=>'index', 'uses' => 'Client\ClientController@index']);
});
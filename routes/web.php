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
    Route::get('/', ['as'=>'index', 'uses' => 'App\Http\Controllers\Admin\HomeController@index']);
});

Route::group(['prefix'=>'client', 'as'=>'client.'], function(){
    Route::get('/', ['as'=>'index', 'uses' => 'App\Http\Controllers\Client\ClientController@index']);
});
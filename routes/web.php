<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
Route::get('/user', 'App\Http\Controllers\UserController@index')->name('user');
Route::get('/admin', 'App\Http\Controllers\AdminController@index')->name('admin');
Auth::routes();

Route::get('/shop', 'App\Http\Controllers\ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'App\Http\Controllers\ShopController@show')->name('shop.show');

Route::resource('/dashboard/product','App\Http\Controllers\ProductController');

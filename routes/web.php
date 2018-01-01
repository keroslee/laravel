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

Route::get('/', function () {
    return redirect('/index.html');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home/{type?}', 'HomeController@index');
    Route::get('/coupon/{brand?}/{type?}', 'CouponController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

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

Route::group(['middleware' => 'locale'], function () {
	Auth::routes();
	Route::get('/', function () {
		return redirect('/index');
	});

	Route::get('/index', 'HomeController@show');

	Route::get('/profile', 'ProfileController@show');

	Route::get('/works', 'WorkController@show');

	Route::get('/wk_details', 'WorkController@detail');

	Route::get('/media', 'MediaController@show');

	Route::get('/events', 'EventController@show');

	Route::get('/jobs', 'JobController@show');
});

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function(){
	Route::get('/', function () {
		return redirect('/admin/home');
	});

	Route::get('/home', 'HomeController@index');

	Route::get('/home_edit', 'HomeController@edit');

	Route::get('/profile', 'ProfileController@index');

	Route::get('/works', 'WorkController@index');

	Route::get('/works_edit', 'WorkController@edit');

	Route::get('/media', 'MediaController@index');

	Route::get('/events', 'EventController@index');

	Route::get('/jobs', 'JobController@index');
});

Route::get('/home22', 'HomeController@index22');

Route::get('/setLang/{lang}', 'SetlocaleController@index');
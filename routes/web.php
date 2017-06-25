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
		return view('index');
	});

	Route::get('/profile', function () {
		return view('profile');
	});

	Route::get('/works', function () {
		return view('works');
	});

	Route::get('/wk_details', function () {
		return view('wk_details');
	});

	Route::get('/media', function () {
		return view('media');
	});

	Route::get('/events', function () {
		return view('events');
	});

	Route::get('/jobs', function () {
		return view('jobs');
	});
});

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function(){
	Route::get('/', function () {
		return redirect('/admin/home');
	});

	Route::get('/home', function () {
		return view('admin.home');
	});

	Route::get('/home_edit', function () {
		return view('admin.home_edit');
	});

	Route::get('/profile', function () {
		return view('admin.profile');
	});

	Route::get('/works', function () {
		return view('admin.works');
	});

	Route::get('/works_edit', function () {
		return view('admin.works_edit');
	});

	Route::get('/media', function () {
		return view('admin.media');
	});

	Route::get('/events', function () {
		return view('admin.events');
	});

	Route::get('/jobs', function () {
		return view('admin.jobs');
	});
});

Route::get('/home', 'HomeController@index');

Route::get('/setLang/{lang}', 'SetlocaleController@index');
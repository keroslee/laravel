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
Route::match(['get', 'post'], '/foo', function () {
    return 'Hello World';
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'Home@index');
    Route::post('/getStatus', 'Home@getStatus');
    Route::post('/uuid', 'Home@uuid');
    Route::match(['get','post'],'/terminal/{tid?}', 'Terminal@index');
    Route::post('/terminal_status', 'Terminal@status');
    Route::match(['get', 'post'], '/company/{status?}', 'Company@index');
    Route::post('/company_status', 'Company@getStatus');
    Route::match(['get', 'post'], '/company_summary', 'CompanySummary@index');
    Route::match(['get', 'post'], '/area_summary', 'AreaSummary@index');
    Route::match(['get','post'],'/info_company', 'Info@company');
    Route::match(['get','post'],'/info_judge', 'Info@judge');
    Route::match(['get','post'],'/info_check', 'Info@check');

    Route::get('/admin', function () {
        return redirect('/admin/area');
    });
    Route::get('/admin/area', 'Admin\Area@index');
    Route::post('/admin/area/add', 'Admin\Area@add');
    Route::post('/admin/area/del', 'Admin\Area@del');
    Route::post('/admin/area/upd', 'Admin\Area@upd');

    Route::match(['get', 'post'], '/admin/company', 'Admin\Company@index');
    Route::post('/admin/company/add', 'Admin\Company@add');
    Route::post('/admin/company/del', 'Admin\Company@del');
    Route::post('/admin/company/upd', 'Admin\Company@upd');
    Route::post('/admin/upload', 'Controller@upload');
    Route::post('/admin/company/import', 'Admin\Company@import');

    Route::match(['get', 'post'], '/admin/approval', 'Admin\Approval@index');
    Route::post('/admin/approval/add', 'Admin\Approval@add');
    Route::post('/admin/approval/del', 'Admin\Approval@del');
    Route::post('/admin/approval/upd', 'Admin\Approval@upd');

    Route::match(['get', 'post'], '/admin/acceptance', 'Admin\Acceptance@index');
    Route::post('/admin/acceptance/add', 'Admin\Acceptance@add');
    Route::post('/admin/acceptance/del', 'Admin\Acceptance@del');
    Route::post('/admin/acceptance/upd', 'Admin\Acceptance@upd');

    Route::match(['get', 'post'], '/admin/check', 'Admin\Check@index');
    Route::post('/admin/check/add', 'Admin\Check@add');
    Route::post('/admin/check/del', 'Admin\Check@del');
    Route::post('/admin/check/upd', 'Admin\Check@upd');

    Route::match(['get', 'post'], '/admin/terminal', 'Admin\Terminal@index');
    Route::post('/admin/terminal/add', 'Admin\Terminal@add');
    Route::post('/admin/terminal/del', 'Admin\Terminal@del');
    Route::post('/admin/terminal/upd', 'Admin\Terminal@upd');

    Route::match(['get', 'post'], '/admin/station', 'Admin\Station@index');
    Route::post('/admin/station/add', 'Admin\Station@add');
    Route::post('/admin/station/del', 'Admin\Station@del');
    Route::post('/admin/station/upd', 'Admin\Station@upd');
    Route::post('/admin/station/terminals', 'Admin\Station@terminals');

    Route::get('admin/userright', 'Admin\UserRight@index');
    Route::post('admin/userright/userright', 'Admin\UserRight@userright');
    Route::post('/admin/userright/upd', 'Admin\UserRight@upd');
});
//Auth::routes();

//Route::get('/home', 'HomeController@index');
Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');
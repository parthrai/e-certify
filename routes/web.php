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
    return view('auth.login');
});

Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('home/video/{id}', function ($id) {
    //return view('dashboard');

    return view('home',['video'=>$id]);
});


Route::get('video', function () {
    //return view('dashboard');

    return view('video');
});




Route::get('/home/video/{id}','HomeController@video');

Route::get('/user/certs','HomeController@checkStatus');

Route::get('/user/activate','UserController@activateAccount');
Route::post('/user/pay','UserController@activateAccount');

Route::post('/user/savenotes','UserController@addNotes');
Route::post('/user/contactSupport','UserController@contactSupport');
Route::post('/user/updateLicense','UserController@addLicenseNumber');

Route::post('/users/video/status','UserController@getVideoStatus');
Route::post('/users/video/update','UserController@updateVideoTable');



// Admin Routes

Route::get('/admin/coupons/list','AdminController@Coupons');
Route::get('/admin/users/list','AdminController@Users');

Route::get('/admin/users/export','AdminController@exportUsers');
Route::get('/admin/users/exportAll','AdminController@exportAllUsers');





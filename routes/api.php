<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/admin/coupons/list','AdminController@listCoupons');
Route::post('/admin/coupons/delete','AdminController@deleteCoupons');
Route::post('/admin/coupons/add','AdminController@addCoupons');

Route::post('/admin/coupons/get','AdminController@getDiscount');

Route::get('/admin/users/list','AdminController@getUsers');
Route::post('/admin/users/activate','AdminController@activateUsers');
Route::post('/admin/users/suspend','AdminController@suspendUsers');
Route::post('/admin/users/delete','AdminController@deleteUsers');


Route::post('/users/video/status','UserController@getVideoStatus');
Route::post('/users/video/update','UserController@updateVideoTable');

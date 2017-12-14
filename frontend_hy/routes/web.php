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
    return view('welcome');
});


Route::get('/', function () {
    return view('index/index');
});

//用户注册
Route::get('user_register', function () {
    return view('register/user_register');
});

Route::post('user_register_to','UserController@user_register_to');

//用户登录
Route::any('user_login', function () {
    return view('login/login');
});
Route::any('user_login_to','UserController@user_login_to');
//用户退出
Route::any('user_del','UserController@user_del');


//用户信息
Route::any('userinfo', function () {
    return view('userinfo/userinfo');
});
Route::any('userinfo_to', function () {
    return view('userinfo/userinfo_to');
});
Route::any('userinfo_add','UserController@userinfo_add');


//主播注册
Route::any('anchor_register', function () {
    return view('register/anchor_register');
});

Route::any('anchor_register_to','AnchorController@anchor_info');


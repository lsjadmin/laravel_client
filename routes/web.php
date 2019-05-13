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

//对称加密
Route::get('/usr/encrypt','User\UserController@encrypt');  //对称加密（加密）
Route::get('/usr/a','User\UserController@encry');
Route::get('/usr/decode','User\UserController@decode');  //对称加密（解密）


Route::get('/test/encrypt','Test\TestController@encrypt');  //对称加密（解密）
Route::get('/test/openssl','Test\TestController@openssl');  //非对称加密（解密）
Route::get('/test/sgin','Test\TestController@sgin');  //非对称加密（解密）
//注册登录
Route::get('/login/add','Login\LoginController@add');  //注册
Route::post('/login/adddo','Login\LoginController@adddo');  //注册执行
Route::get('/login','Login\LoginController@login');  //登录
Route::post('/logina','Login\LoginController@logina');  //登录
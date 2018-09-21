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
Auth::routes();

include __DIR__."/index/web.php";
include __DIR__."/index/index.php";
include __DIR__."/home/web.php";
include __DIR__."/mobile/web.php";

Route::get('/home', 'HomeController@index')->name('home');
Route::get('test', 'TestController@index');

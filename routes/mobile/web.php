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

Route::group(['namespace'=>'Mobile', 'prefix'=>'mobile'],function(){
//  首页
    Route::get('/index','IndexController@index')->name('mobile.index.index');
    Route::get('/goods','IndexController@getGoodsByCat')->name('mobile.index.goods');
    Route::get('search','IndexController@searchGoods')->name('mobile.index.search');
    Route::get('getSearchGoods','IndexController@getSearchGoods')->name('mobile.index.getSearchGoods');
    Route::get('test','IndexController@test')->name('mobile.index.test');

});

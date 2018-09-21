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

Route::group(['namespace'=>'Index'],function(){

    Route::get('/','EntryController@index')->name('entry');
    Route::get('/detail','UserGoodsController@showDetail')->name('entry.goods.detail');
    Route::get('/entest','UserGoodsController@test')->name('entry.test');


});
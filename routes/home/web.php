<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/11
 * Time: 20:32
 */
Route::group(['prefix'=>'home','namespace'=>'Home'],function(){
    Route::get('/index','IndexController@index');
    
});

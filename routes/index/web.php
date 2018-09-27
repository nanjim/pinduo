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

Route::group(['namespace'=>'Index', 'prefix'=>'index'],function(){

//账号相关
    Route::get('/password/getReset','UserController@getReset')->name('password.getReset');
    Route::post('/password/postReset','UserController@postReset')->name('password.postReset');
    Route::post('/password/modifyPassword','UserController@modifyPassword')->name('index.postModifyPassword');
//  商品与推广
    Route::post('goods/postDetail','GoodsController@postDetail');
    Route::get('goods/getDetail','GoodsController@getDetail')->name('goods.detail');
    Route::get('user/star','UserController@star')->name('index.star')->middleware('checkLogin');
    Route::get('/getCatList','IndexController@getCatList');
    Route::get('/myprofile/addSpread','SpreadController@addSpread')->name('index.myprofile.addSpread');
    Route::post('/myprofile/postSpread','SpreadController@postSpread')->name('index.postSpread');
    Route::get('/myprofile/test','SpreadController@test')->name('testspread');
    Route::post('/spread','SpreadController@addTeam')->name('index.spread');
    Route::get('/team_show', 'GoodsController@teamShow')->name('index.team_show');
//个人中心
    Route::get('/myprofile/spread','SpreadController@showSpread')->name('index.myprofile.spread');
    Route::get('/myprofile/baseData','UserController@showBaseData')->name('index.myprofile.baseData');
    Route::match(['get', 'post'], '/baseData/edit','UserController@editBaseData')->name('index.baseData.edit');
    Route::get('/myprofile/myNotice','UserController@myNotice')->name('index.myprofile.myNotice');
    Route::get('/myprofile/noticeDesc','UserController@noticeDesc')->name('index.myprofile.noticeDesc');
    Route::get('/myprofile/merchandiseManage','UserController@showMerchandiseManage')->name('index.myprofile.merchandiseManage');
    Route::get('/myprofile/modifyPassword','UserController@showModifyPassword')->name('index.myprofile.modifyPassword');
    Route::get('/myprofile/myStar','UserController@showMyStar')->name('index.myprofile.myStar');
    Route::post('/mystar/del','UserController@delMystar')->name('index.star.del');
    Route::get('/mystar/clear','UserController@clearMystar')->name('index.star.clear');
    Route::get('/myprofile/mySite','UserController@showMySite')->name('index.myprofile.mySite');
    Route::post('/myprofile/keepSiteTitle','UserController@keepSiteTitle')->name('index.myprofile.keepSiteTitle');
    Route::post('/myprofile/changeTitle', 'UserController@changeTitle')->name('index.myprofile.changeTitle');

//我的商品
    Route::get('/usergoods/goodsOperation', 'UserController@goodsOperation')->name('index.usergoods.goodsOperation');

//    支付
    Route::get('/myprofile/charge', 'ChargeController@charge')->name('index.myprofile.charge');
    Route::post('/myprofile/postCharge', 'ChargeController@postCharge')->name('index.charge.postCharge');
    Route::get('/myprofile/charge/test', 'ChargeController@test');
//图片上传
    Route::post('/uploadImg', 'UserController@uploadImg')->name('index.uploadImg');
//  测试
    Route::get('/testRedis', 'EntryController@testRedis');
    Route::get('/test', 'EntryController@test');

});
Route::post('/sendMessage', 'Auth\RegisterController@sendMessage')->name('index.sendMessage');
<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

//    HomeController
    $router->get('', 'HomeController@index');

//    TeamController
    $router->resource('teams/teams', TeamController::class);
    $router->get('test', "TeamController@test");
    $router->get('teams/checkPass', "TeamController@checkPass");
    $router->get('teams/showReject', "TeamController@showReject")->name('team.reject');
    $router->post('teams/dealReject', "TeamController@dealReject")->name('team.dealReject');

//    goods
    $router->resource('goods/goods', GoodsController::class);
    $router->get('goods/check', 'GoodsController@check');
    $router->get('goods/reject', 'GoodsController@reject')->name('goods.reject');
    $router->post('goods/dealReject', 'GoodsController@dealReject')->name('goods.dealReject');
//  goods_cats
    $router->resource('goods_cats/goods_cats', GoodsCatsController::class);
//    UserController
    $router->resource('teams/users', UserController::class);

//    PhotoController
    $router->resource('photos/photos', PhotoController::class);
//充值
    $router->resource('charge/set', ChargeController::class);
});

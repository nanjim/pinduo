<?php

namespace App\Http\Controllers\Index;

use App\Http\Traits\UserGoods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\getMsgCount;
use Illuminate\Support\Facades\Redis;

class EntryController extends Controller
{
    use UserGoods;

    protected $goods;

    function __construct()
    {
        $goods = new UserGoodsController();
        $this->goods = $goods;
    }

    function index(Request $request)
    {
        $this->getMsgCount();
        $index = $request->input('index', 1);
        switch ($index) {
            case 1: $params = $request->all();
                    $view = $this->selectGoodsByDefault($params);
                    break;
            case 2: $view = $this->showTodayTop();
                    break;
            case 3: $view = $this->showMysite();
                    break;
            default: $params = $request->all();
                     $view = $this->selectGoodsByDefault($params);
        }
        return $view;
    }

    function selectGoodsByDefault($params)
    {
        $goodsList = $this->goodsList($params);
        $view = $this->showGoodsList($goodsList);
        return $view;
    }

    /**
     * @param $params
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    function goodsList($params)
    {
        $goods = $this->goods;
        $goodsList = $goods->getGoods($params);

        return $goodsList;
    }

    function showGoodsList($goodsList)
    {
        return view('index.entry.index', ['goodsList'=>$goodsList, 'index'=>1]);
    }

    function showMysite()
    {
        return view('index.entry.mysite', ['index'=>3]);
    }

    function showTodayTop()
    {
        return view('index.entry.top', ['index'=>2]);
    }

    function getMsgCount()
    {
        event(new getMsgCount());
    }

    function testRedis()
    {
        Redis::setex('name', 10, 'hi');
    }

    function test()
    {
        $name = Redis::get('name');
        echo $name;
    }


}

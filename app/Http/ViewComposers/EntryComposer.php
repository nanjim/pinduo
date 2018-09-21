<?php

namespace App\Http\ViewComposers;

use App\Http\Traits\UserGoods;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Model\Index\User;

class EntryComposer
{

    use UserGoods;

    protected $query;
    protected $index;

    function __construct(Request $request)
    {
        error_reporting(E_ERROR);
        $query = $request->all();
        $this->query = $query;
//        $this->index = $query['index'] ?: 1;
    }

    function compose(View $view)
    {
        $sort = $this->getSortItmes();
        $view->with(['cat_list'=>$this->getGoodsCats(), 'query'=>$this->query, 'sort'=>$sort]);
    }

    function getSortItmes()
    {
        $item['title'] = '综合排序';
        $item['desc'] = '0';
        $item['asc'] = '0';
        $sort[] = $item;

        $item['title'] = '销量';
        $item['desc'] = '1';
        $item['asc'] = '2';
        $sort[] = $item;

        $item['title'] = '券后价';
        $item['desc'] = '4';
        $item['asc'] = '3';
        $sort[] = $item;

        $item['title'] = '佣金比率';
        $item['desc'] = '5';
        $item['asc'] = '6';
        $sort[] = $item;

        $item['title'] = '优惠券';
        $item['desc'] = '7';
        $item['asc'] = '8';
        $sort[] = $item;

        return $sort;
    }
}
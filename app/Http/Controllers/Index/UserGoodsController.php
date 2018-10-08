<?php

namespace App\Http\Controllers\Index;

use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\Exception;

class UserGoodsController extends Controller
{

    function showMyGoods()
    {

    }

    function goodsList($params)
    {
        $goods = $this->getGoods($params);
        return $goods;
    }

    function getGoods($params)
    {
        error_reporting(E_ERROR|E_PARSE);
        $page = isset($params['page']) ? $params['page'] : 1;
        unset($params['page']);
        $params['onsale'] = 1;
        $params['status'] = 1;

        $query = $params;
        if (isset($params['range_list'])) {
            $range_from = $params['range_list']['range_from'] ?: 0;
            $range_to = $params['range_list']['range_to'];

            $rate = $params['range_list']['rate'] ?: 0;
            $sale_num = $params['range_list']['sale_num'] ?: 0;
            $params[] = ['after_price', '>', (float)$range_from];
            if (!is_null($range_to)) {
                $params[] = ['after_price', '<', (float)$range_to];
            }
            $params[] = ['sale_num', '>', (int)$sale_num];
            $params[] = ['rate', '>', (int)$rate+0];
            unset($params['range_list']);
        }

        if (isset($params['title'])) {
            $params[] = ['title', 'like', '%'.$params['title'].'%'];
            unset($params['title']);
        } else if (is_null($params['title'])) {
            unset($params['title']);
        }

        if (isset($params['sort_type'])) {
            $sort = [];
            switch ($params['sort_type']) {
                case 0: $sort['sort_name'] = 'id';
                        $sort['sort_type'] = 'asc';
                        break;
                case 1: $sort['sort_name'] = 'sale_num';
                        $sort['sort_type'] = 'desc';
                        break;
                case 2: $sort['sort_name'] = 'sale_num';
                        $sort['sort_type'] = 'asc';
                        break;
                case 3: $sort['sort_name'] = 'after_price';
                        $sort['sort_type'] = 'asc';
                        break;
                case 4: $sort['sort_name'] = 'after_price';
                        $sort['sort_type'] = 'desc';
                        break;
                case 5: $sort['sort_name'] = 'rate';
                        $sort['sort_type'] = 'desc';
                        break;
                case 6: $sort['sort_name'] = 'rate';
                        $sort['sort_type'] = 'asc';
                        break;
                case 7: $sort['sort_name'] = 'coupon_amount';
                        $sort['sort_type'] = 'desc';
                        break;
                case 8: $sort['sort_name'] = 'coupon_amount';
                        $sort['sort_type'] = 'asc';
                        break;
                default: $sort['sort_name'] = 'id';
                         $sort['sort_type'] = 'asc';
            }
            unset($params['sort_type']);
        } else {
            $sort['sort_name'] = 'id';
            $sort['sort_type'] = 'asc';
        }

        if (isset($params['index'])) {
            unset($params['index']);
        }
        $goods = DB::table('outer_goods')->where($params);
        $goodsData = DB::table('goods')->where($params)->unionAll($goods)->orderBy($sort['sort_name'], $sort['sort_type'])->get()->all();
        $res = array_slice($goodsData, ($page-1)*100, 100);
        $paginator = new LengthAwarePaginator($res, count($goodsData), 100);
        $paginator->setPath(Paginator::resolveCurrentPath());
        $paginator->query = $query;
        $paginator->totalSize = count($goodsData);

        return $paginator;
    }

}

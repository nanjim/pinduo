<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
        function index()
        {

        }

        function getAllCats()
        {
            $client_id = config('pdd.client_id');
            $client_secret = config('pdd.client_secret');
            $url = config('pdd.api_url');

            $time = time();
            $params['client_id'] = $client_id;
            $params['timestamp'] = $time;
            $params['parent_cat_id'] = 0;
            $params['type'] = 'pdd.goods.cats.get';
            $sign = _sign($client_secret,$params);

            $params['sign'] = $sign;
            $res_data_json = _curl_post($url,$params);
            $res_data = json_decode(_curl_post($url,$params));

            if (isset($res_data->error_response)) {
                throw new Exception($res_data_json);
            }
            $data_bare = $res_data->goods_cats_get_response;
            $resp = $data_bare->goods_cats_list;
            foreach ($resp as $val) {
                $item['cat_id'] = $val->cat_id;
                $item['pin_name'] = $val->cat_name;
                $item['name'] = $val->cat_name;
                $item['in_use'] = 0;
                $item['sort'] = 1;
                $res = DB::table('cats')->insert($item);
                echo $res;
            }
        }

        function getGoods()
        {

        }



}

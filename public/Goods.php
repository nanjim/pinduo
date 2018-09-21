<?php
include 'PDOTool.php';
class Goods
{

    protected $url = 'http://gw-api.pinduoduo.com/api/router';
    protected $client_id = '8b061d7a7e7c420c8ed3c42e0e001e39';
    protected $client_secret = '8acd45309d14d077cb3c9c1674823826157653eb';

    function getAllGoods()
    {
        $cats = $this->getUserGoodsCats();
        $goods = [];
        foreach ($cats as $cat) {
            $data = [];
            $cat_id = $cat['cat_id'];
            for ($i=1; $i<=1; $i++) {
                $params['page'] = $i;
                $params['cat_id'] = $cat_id;
                $item = $this->getGoods($params);
                $data = array_merge($data, $item);
            }
            $goods = array_merge($goods, $data);
        }
        return $goods;
    }

    function getGoods($params)
    {
        $client_id = $this->client_id;
        $client_secret = $this->client_secret;
        $url = $this->url;

        $time = time();
        $params['page_size'] = 100;
        $params['client_id'] = $client_id;
        $params['timestamp'] = $time;
        $params['type'] = 'pdd.ddk.goods.search';
        $params['sort_type'] = 0;
        $params['with_coupon'] = 'true';
        $sign = $this->_sign($client_secret,$params);
        $params['sign'] = $sign;

        $res_data_json = $this->_curl_post($url,$params);
        $res_data = json_decode($this->_curl_post($url,$params));

        if (isset($res_data->error_response)) {
            throw new Exception($res_data_json);
        }

        $data_bare = $res_data->goods_search_response;
        $data = $data_bare->goods_list;
        return $data;
    }

    function storeGoods()
    {
        $goods = $this->getAllGoods();
        $data = [];
        foreach ($goods as $val) {
            $item['title'] = htmlspecialchars(addslashes($val->goods_name));
            $item['goods_id'] = $val->goods_id;
            $item['user_id'] = 44;
            $item['cat_id'] = $val->cat_ids[0];
            $item['status'] = 1;
            $item['onsale'] = 1;
            $item['type'] = 1;
            $item['score'] = $val->goods_eval_score ?: 0;
            $item['sale_num'] = $val->sold_quantity;
            $item['origin_price'] = (float)$val->min_group_price/100;
            $item['coupon_amount'] = $val->coupon_discount/100;
            $item['after_price'] = $item['origin_price']-$item['coupon_amount'];
            $item['coupon_num'] = $val->coupon_total_quantity ?: 0;
            $item['coupon_remain'] = $val->coupon_remain_quantity ?: 0;
            $item['rate'] = $val->promotion_rate/10;
            $item['commission'] = round($item['after_price']*$item['rate']/100, 2);
            $item['start_time'] = date('Y-m-d H:i:s', $val->coupon_start_time);
            $item['end_time'] = date('Y-m-d H:i:s', $val->coupon_end_time);
            $item['copy_text'] = '';
            $item['imgs'] = $val->goods_image_url;
            $item['main_img'] = $val->goods_thumbnail_url;
            $data[] = $item;
        }
//        var_dump($data);exit();

        try {
            $pdo = new PDOTool();
            $pdo->pdo->exec('truncate table outer_goods');
            $res = $pdo->insertBatch("outer_goods", $data);
            echo $res;

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function getAllCats()
    {
        $client_id = $this->client_id;
        $client_secret = $this->client_secret;
        $url = $this->url;

        $time = time();
        $params['client_id'] = $client_id;
        $params['timestamp'] = $time;
        $params['parent_cat_id'] = 0;
        $params['type'] = 'pdd.goods.cats.get';
        $sign = $this->_sign($client_secret,$params);

        $params['sign'] = $sign;
        $res_data_json = $this->_curl_post($url,$params);
        $res_data = json_decode($this->_curl_post($url,$params));

        if (isset($res_data->error_response)) {
            throw new Exception($res_data_json);
        }
        $data_bare = $res_data->goods_cats_get_response;
        $resp = $data_bare->goods_cats_list;
        return $resp;
    }

    function getUserGoodsCats()
    {

        $pdo = new PDOTool();
        $res = $pdo->query('select*from cats where in_use=1');
        return $res;
    }

    //拼多多签名
    function _sign($client_secret,$params)
    {
        ksort($params);
        $strtobind = $client_secret;
        foreach ($params as $key => $value) {
            if (!is_array($value)) {
                $strtobind .= "$key$value";
            }
        }
        unset($key,$value);
        $strtobind .= $client_secret;
        $sign = strtoupper(md5($strtobind));
        return $sign;
    }

// 拼多多数据返回
    function _curl_post($url,$params)
    {
        $data_string = json_encode($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:application/json;",
        ));
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function setCats($resp)
    {
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

    function insertGoods()
    {

    }

    function test()
    {
        $pdo = new PDOTool();
        for ($i=0; $i<100; $i++) {
            $pdo->insert('test', ['num'=>$i]);
        }

    }

}

$goods = new Goods();
$goods->storeGoods();
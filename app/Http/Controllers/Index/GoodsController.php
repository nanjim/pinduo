<?php

namespace App\Http\Controllers\Index;

use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Mockery\Exception;

class GoodsController extends Controller
{

    /**
     * @param $params
     * @return mixed
     * 从接口获取商品数据
     */
    function getGoodsData($params)
    {
        $client_id = config('pdd.client_id');
        $client_secret = config('pdd.client_secret');
        $time = time();
        $params['client_id'] = $client_id;
        $params['timestamp'] = $time;
        $sign = _sign($client_secret,$params);
        $url = config('pdd.api_url');
        $params['sign'] = $sign;
//        dd(_curl_post($url,$params));
        $res_data_json = _curl_post($url,$params);
        $res_data = json_decode(_curl_post($url,$params));

        if (isset($res_data->error_response)) {
            throw new Exception($res_data_json);
        }

        $data_bare = $res_data->goods_search_response;
        $data['goods_list'] = $data_bare->goods_list;
        $data['total_size'] = $data_bare->total_count < 10000 ? $data_bare->total_count : 10000;
        return $data;
    }

    /**
     * @return array
     * 获取所有可用商品分类
     */
    function getGoodsCats()
    {
        $cat_list = DB::select("select * from cats where in_use=1");
        return $cat_list;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 获取商品详情
     */
    function getDetail(Request $request)
    {
        $id = $request->input('id');
        $res = $this->getDetailData($id);
        $team = $this->getGoodsOwner($id);
        if ($res['status']) {
            if ($team) {
                return view('index.goods.detail', ['data'=>$res['data'], 'goods_id'=>$id, 'index'=>1, 'team'=>$team]);
            } else {
                return view('index.goods.detail', ['data'=>$res['data'], 'index'=>1, 'goods_id'=>$id]);
            }

        } else {
            $data['status'] = false;
            $data['msg'] = '该商品已下架';
            return back()->with($data);
        }
    }

    function getGoodsOwner($goods_id)
    {
        $user_id = DB::table('goods')->where(['goods_id'=>$goods_id])->value('user_id');
        if ($user_id) {
            $goodsCount = DB::table('goods')->where(['user_id'=>$user_id, 'onsale'=>1, 'status'=>1])->count();
            $team = DB::table('teams')->where('user_id', $user_id)->first();
            $team->avatar = DB::table('users')->where('id', $user_id)->value('avatar');
            $team->goodsCount = $goodsCount;
            return $team;
        } else {
            return false;
        }
    }

    function getOwnerInfo($user_id)
    {
        if ($user_id) {
            $data['goodsCount'] = DB::table('goods')->where(['user_id'=>$user_id, 'onsale'=>1, 'status'=>1])->count();
            $data['team'] = DB::table('teams')->where('user_id', $user_id)->first();
            $data['avatar'] = DB::table('users')->where('id', $user_id)->value('avatar');
            return $data;
        } else {
            return false;
        }
    }

    function getDetailData($id)
    {
        error_reporting(E_ERROR);
        $oid = $id;
        $id = "[".$oid."]";
        $client_id = config('pdd.client_id');
        $client_secret = config('pdd.client_secret');
        $time = time();
        $params = array(
            'type' => 'pdd.ddk.goods.detail',
            'goods_id_list' => $id,
            'timestamp' => $time,
            'client_id' => $client_id,
        );
        $sign = _sign($client_secret,$params);
        $url = config('pdd.api_url');
        $params['sign'] = $sign;
        $data = json_decode(_curl_post($url,$params))->goods_detail_response->goods_details[0];
        if (!isset($data)) {
            $res = DB::table('outer_goods')->where('goods_id', '=', $oid)->delete();
            $res['status'] = false;
            return $res;
        }
        $res['status'] = true;
        $res['data'] = $data;
        dd($res);
        return $res;
    }

    function teamShow(Request $request)
    {
        $user_id = $request->input('user_id');
        if (!$user_id) {
            exit('未找到相关信息');
        }
        $data = $this->getOwnerInfo($user_id);
        $data['goods_list'] = DB::table('goods')->where(['user_id'=>$user_id, 'onsale'=>1, 'status'=>1])->get();
        return view('index.goods.team_show', ['data'=>$data, 'index'=>1]);
    }

    /**
     * @param Request $request
     * 将长链接转成短链接
     */
    function transLink($link)
    {
        $url_short =  file_get_contents("http://mrw.so/api.php?url=".$link);
        $is_url = preg_match("/http:\/\//", $url_short);
        if (!$is_url) {
            return $this->getShortLink($link);
        }
        return $url_short;
    }

}

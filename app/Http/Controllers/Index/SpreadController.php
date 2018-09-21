<?php

namespace App\Http\Controllers\Index;

use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Index\Team;
use Illuminate\Support\Facades\Auth;

class SpreadController extends Controller
{

    function __construct()
    {
        $this->middleware('checkLogin')->except('test');
    }

    function addTeam(Request $request)
    {
        $request->validate([
            'name' => 'required|max:50',
            'type' => 'required',
            'qq' => 'numeric|digits_between:5,18',
            'weixin' => 'alpha_num|max:18',
            'income' => 'required|max:10',
            'desc' => 'required',
        ]);
        $req = $request->all();
        $team = new Team();
        $team->name = $req['name'];
        $team->type = $req['type'];
        $team->qq = $req['qq'];
        $team->weixin = $req['weixin'];
        $team->income = $req['income'];
        $team->desc = $req['desc'];
        $team->user_id = Auth::id();
        $res = $team->save();
        if ($res) {
            return view('index.user.waitCheck',['item'=>'spread']);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *author
     *date 2018/8/6
     */
    function showSpread()
    {
        $user_id = Auth::id();
        $team = Team::where('user_id', $user_id)->first();
        if (!is_null($team)) {
            $status = $team->status;
            if ($status) {
                return view('index.user.addSpread',['item'=>'spread']);
            }
            return view('index.user.waitCheck',['item'=>'spread']);
        } else {
            return view('index.user.spread',['item'=>'spread']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 获取商品详情
     */
    function addSpread(Request $request)
    {
        $link = $request->input('link');
        $getGoodsId = $this->getGoodsId($link);

        if (!$getGoodsId['status']) {

            $data['status'] = $getGoodsId['status'];
            $data['msg'] = $getGoodsId['msg'];
            return response()->json($data);
        }

        try{
            $goods = new GoodsController();
            $detail = $goods->getDetailData($getGoodsId['goods_id']);
            $cats = $goods->getGoodsCats();
            $data['status'] = true;
            $data['data'] = $detail;
            $data['cats'] = $cats;
            return response()->json($data);

        }catch (\Exception $e) {
            $data['status'] = false;
            $data['msg'] = '验签失败';
            return response()->json($data);
        }
    }

    function postSpread(Request $request)
    {
        $user_id = Auth::id();
        $detail = $request->all();
        $detail['commission'] = round($detail['after_price']*$detail['rate']/100, 2);
        $goods = new Goods();
        $goods->title = $detail['title'];
        $goods->cat_id = $detail['cat_id'];
        $goods->score = $detail['score'];
        $goods->sale_num = $detail['sale_num'];
        $goods->start_time = $detail['start_time'];
        $goods->end_time = $detail['end_time'];
        $goods->origin_price = $detail['origin_price'];
        $goods->after_price = $detail['after_price'];
        $goods->coupon_amount = $detail['coupon_amount'];
        $goods->coupon_num = $detail['coupon_num'];
        $goods->coupon_remain = $detail['coupon_remain'];
        $goods->copy_text = $detail['copy_text'];
        $goods->rate = $detail['rate'];
        $goods->imgs = $detail['imgs'];
        $goods->main_img = $detail['main_img'];
        $goods->goods_id = $detail['goods_id'];
        $goods->user_id = $user_id;
        $goods->commission = $detail['commission'];
        $res = $goods->save();
        if ($res) {
            return back()->with(['status'=>true]);
        }
    }

    /**
     * @param $link
     * @return mixed
     * 获取商品id(goods_id)，从链接中找出带有goods_id的商品id；
     */
    function getGoodsId($link)
    {
        try{
            preg_match('/goods_id=\d{1,}/', $link, $matchs);
            preg_match('/\d{1,}/', $matchs[0], $matchs_res);
            $data['status'] = true;
            $data['goods_id'] = $matchs_res[0];
            return $data;

        }catch (\Exception $e) {
            $data['status'] = false;
            $data['msg'] = '没有找到该商品';
            return $data;
        }

    }

    function test()
    {
        $goods = new GoodsController();
        $detail = $goods->getDetailData(2560081869);
        return response()->json($detail);
    }

}

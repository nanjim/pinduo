<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;

trait UserGoods {

    function getUserGoods()
    {
        $user_id = $this->user_id;
        $goods = DB::table('goods')->where('user_id', '=', $user_id)->paginate(5);
        return $goods;
    }

    function getUserShowGoods()
    {
        $user_id = $this->user_id;
        $goods = DB::table('goods')->where(['user_id'=>$user_id, 'status'=>1, 'onsale'=>1])->paginate(5);
        return $goods;
    }

    function getUserUncheckGoods()
    {
        $user_id = $this->user_id;
        $goods = DB::table('goods')->where(['user_id'=>$user_id, 'status'=>0])->paginate(5);
        return $goods;
    }

    function getUserDownGoods()
    {
        $user_id = $this->user_id;
        $goods = DB::table('goods')->where(['user_id'=>$user_id, 'onsale'=>0])->paginate(5);
        return $goods;
    }

    function getUserRejectGoods()
    {
        $user_id = $this->user_id;
        $goods = DB::table('goods')->where(['user_id'=>$user_id, 'status'=>2])->paginate(5);
        return $goods;
    }

    function getGoodsCats()
    {
        $cat_list = DB::table('cats')->where(['in_use'=>1])->get();
        return $cat_list;
    }

    function upGoods($id)
    {
        $status = DB::table('goods')->where(['id'=>$id])->update(['onsale'=>1]);
        $res['status'] = $status;
        $res['msg'] = '上架成功';
        return $res;
    }

    function downGoods($id)
    {
        $status = DB::table('goods')->where(['id'=>$id])->update(['onsale'=>0]);
        $res['status'] = $status;
        $res['msg'] = '下架成功';
        return $res;
    }

    function delGoods($id)
    {
        $status = DB::table('goods')->where(['id'=>$id])->delete();
        $res['status'] = $status;
        $res['msg'] = '删除成功';
        return $res;
    }


}
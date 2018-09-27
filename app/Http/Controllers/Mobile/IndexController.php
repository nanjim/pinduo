<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Index\GoodsController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Photo;

class IndexController extends Controller
{
    function index(Request $request)
    {
        $querys = $request->all();
        $user_id = session('user_id');
        if (empty($user_id)) {
            $user_id = $querys['user_id'];
        }
        $hasTitle = $request->session()->has('title');
        session(['user_id'=>$user_id]);

        if (!$hasTitle) {
            $title = $this->getTitle($user_id);
            session(['title'=>$title]);
        }

        $flashs = Photo::where('type','mindex')->orderBy('sort')->take(4)->get();
        $cats = \DB::select('select*from cats where in_use=1');
        return view('mobile.index.index', ['flashs'=>$flashs, 'cats'=>$cats, 'querys'=>$querys, 'ptype'=>1]);
        //p-type表示第几个页面，1：表示首页；2：表示搜索页

    }

    function getTitle($user_id)
    {
        $title = \DB::table('sites')->where('user_id', '=', $user_id)->value('title');
        return $title;
    }

    function getGoodsByCat(Request $request)
    {
        $req = $request->all();
        $params['type'] = 'pdd.ddk.goods.search';
        $params['page'] = $req['num'];
        $params['page_size'] = $req['size'];
        $params['sort_type'] = isset($req['sort']) ? $req['sort'] : 0;
        $params['with_coupon'] = 'true';
        $params['cat_id'] = isset($req['cat_id']) ? $this->getRealCatId($req['cat_id']) : 0;
        $goods = new GoodsController();
        $goods_data = $goods->getGoodsData($params);
        return response()->json($goods_data);
    }

    function getRealCatId($id)
    {
        $cat_id = \DB::table('cats')->where('id',$id)->value('cat_id');
        return $cat_id;
    }

    function searchGoods(Request $request)
    {
        $req = $request->all();
        return view('mobile.index.search',['querys'=>$req, 'ptype'=>2]);
        //p-type表示第几个页面，1：表示首页；2：表示搜索页
    }

    function getSearchGoods(Request $request)
    {
        if (!empty($request->input('q'))) {
            $params['keyword'] = $request->input('q','');
        }
        $params['sort_type'] = $request->input('sort',0);
        $params['page'] = $request->input('num',1);
        $params['page_size'] = $request->input('size',10);
        $params['type'] = 'pdd.ddk.goods.search';
        $params['with_coupon'] = 'true';
        $goods = new GoodsController();
        $goods_data = $goods->getGoodsData($params);
        return response()->json($goods_data);
    }

}

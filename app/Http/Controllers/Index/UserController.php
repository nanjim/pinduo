<?php

namespace App\Http\Controllers\Index;

use App\Events\getMsgCount;
use App\Http\Traits\UserGoods;
use App\Model\Index\User;
use App\Model\Star;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    use UserGoods;

    protected $user_id;

    function __construct()
    {
        $this->middleware('checkLogin')->except('getReset', 'postReset');
    }

    public function getReset()
    {
    	return view('auth.passwords.resetPassword');
    }

    public function postReset(Request $request)
    {
        $data = $request->all();
        $this->resetPasswordValidator($data)->validate();
        $password = $data['password'];
        $mobile = $data['mobile'];
        $exists = \DB::table('users')->where('mobile', '=', $mobile)->exists();
        $res = \DB::table('users')->where('mobile', '=', $mobile)->update(['password'=>bcrypt($password)]);
        if ($res) {
            return redirect('/login')->with(['status'=>true]);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *author chunzai
     *date 2018/8/6
     */
    function showBaseData()
    {
        $user_id = Auth::id();
        $user = User::join('teams', 'teams.user_id', '=', 'users.id')->find($user_id);
        $has_team = isset($user->user_id) && $user->user_id > 0;
        return view('index.user.baseData',['item'=>'baseData','user'=>$user, 'has_team'=>$has_team]);
    }

    function resetPasswordValidator($data)
    {
        $messages = [
            'mobile.exists' => '该手机号未注册',
            'mobile.size' => '手机号格式有误',
            'mobile.required' => '请填写手机号',
            'password.required' => '请填写密码',
            'password.min' => '密码最小长度为6',
            'confirmed' => '两次密码输入不一致，请重新输入',
            'verify.required' => '验证码不能为空',
        ];

        return Validator::make($data, [
            'mobile' => 'bail|required|string|size:11|exists:users,mobile',
            'password' => 'required|string|min:6|confirmed',
            'verify' => ['required', 'digits:4', function($attr, $value, $fail){
                $vcode = session('vcode');
                if ($vcode != $value) {
                    return $fail($vcode.'验证码不正确');
                }
            }]
        ],$messages);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     *author chunzai
     *date 2018/8/6
     */
    public function modifyPassword(Request $request)
    {
        $origin_password = $request->post('origin_password');
        $new_password = $request->post('new_password');
//        dd(session());
        $user = \Auth::user();
        $data = $request->post();
        $rules = [
            'origin_password' => 'required|between:6,20',
            'new_password' => 'required|between:6,20|confirmed',
        ];
        $message = [
            'confirmed' => '新密码和确认密码不匹配',
            'required' => '密码不能为空',
            'between' => '密码必须在6~20位之间'
        ];
        $validator = Validator::make($data,$rules,$message);
        $validator->after(function($validator) use ($origin_password,$user) {
            if (!Hash::check($origin_password,$user->password)) {
                $validator->errors()->add('origin_password','原密码错误');
            }
        })->validate();

        $user->password = bcrypt($new_password);
        $user->save();
        return back()->with('success','修改成功');
//        return view('');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *author chunzai
     *date 2018/8/6
     */
    function showModifyPassword()
    {
        return view('index.user.modifyPassword',['item'=>'modifyPassword']);
    }

    /**
     * @param $id
     * @return string
     *author name
     *date 2018/8/7
     */
    function star(Request $request){
        $id = $request->input('id');
        $user_id = Auth::id();
        $data['user_id'] = $user_id;
        $data['goods_id'] = $id;
        $is_exist = \DB::table('star')->where($data)->value('id');

        if(isset($is_exist) && $is_exist>0){
            $res['status'] = true;
            $res['is_exist'] = true;
            return response()->json($res);
        }
        $insert_res = \DB::table('star')->insert($data);
        $res['status'] = $insert_res;
        return response()->json($res);
    }

    function getStarNum()
    {

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *author chunzai
     *date 2018/8/6
     */
    function showMerchandiseManage(Request $request)
    {
        $this->user_id = Auth::id();
        $show_type = $request->input('show_type', '0');
        switch ($show_type) {
            case 0: $user_goods = $this->getUserGoods();
                    break;
            case 1: $user_goods = $this->getUserShowGoods();
                    break;
            case 2: $user_goods = $this->getUserUncheckGoods();
                    break;
            case 3: $user_goods = $this->getUserDownGoods();
                    break;
            case 4: $user_goods = $this->getUserRejectGoods();
        }

        return view('index.user.merchandiseManage',['item'=>'merchandiseManage', 'user_goods'=>$user_goods, 'show_type'=>$show_type]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *author chunzai
     *date 2018/8/6
     */
    function showMyStar()
    {
        $goods_stars = \DB::table('star')->join('goods', 'goods.goods_id', '=', 'star.goods_id')
            ->select('goods.main_img', 'goods.title', 'goods.goods_id', 'goods.after_price', 'goods.origin_price',
                'goods.sale_num', 'goods.commission', 'goods.rate', 'star.id as id', 'goods.coupon_amount',
                'goods.coupon_remain', 'goods.coupon_num')->get()->all();
        $out_goods_stars = \DB::table('star')->join('outer_goods', 'outer_goods.goods_id', '=', 'star.goods_id')
            ->select('outer_goods.main_img', 'outer_goods.title', 'outer_goods.goods_id', 'outer_goods.after_price', 'outer_goods.origin_price',
            'outer_goods.sale_num', 'outer_goods.commission', 'outer_goods.rate', 'star.id as id', 'outer_goods.coupon_amount',
                'outer_goods.coupon_remain', 'outer_goods.coupon_num')->get()->all();
        $stars = array_merge($goods_stars, $out_goods_stars);
        $goods_ids = [];
        foreach ($stars as $k=>$star) {
            if (in_array($star->goods_id, $goods_ids)) {
                unset($stars[$k]);
            } else {
                $goods_ids[] = $star->goods_id;
            }

        }
        return view('index.user.myCollection',['item'=>'myCollection', 'stars'=>$stars]);
    }

    function clearMystar()
    {
        $user_id = Auth::id();
        $int = \DB::table('star')->where(['user_id'=>$user_id])->delete();
        if ($int) {
            $res['status'] = true;
            $res['msg'] = '清除成功';
            return response()->json($res);
        }
    }

    function showMySite()
    {
        $user_id = Auth::id();
        $site = \DB::table('sites')->where('user_id', '=', $user_id)->first();
        return view('index.user.mySite',['item'=>'mySite', 'site'=>$site]);
    }

    function keepSiteTitle(Request $request)
    {
        $title = $request->input('title');
        $id = $request->input('id');
        \DB::table('sites')->where('id', $id)->update(['title'=>$title]);
    }

    /**
     * 修改网站标题
     */
    function changeTitle(Request $request)
    {
        $title = $request->input('title');
        return response()->json($title);
        $user_id = Auth::user()->id;
        $res = \DB::table('sites')->where('user_id', '=', $user_id)->update(['title'=>$title]);
        if ($res) {
            $data['status'] = true;
            $data['msg'] = '修改成功';
            session(['title'=>$title]);
            return response()->json($data);
        }
    }

    function myNotice()
    {
        event(new getMsgCount());
        $notices = \DB::table('notices')->where(['user_id'=>Auth::user()->id])->orderBy('created_at', 'desc')->paginate(5);
        return view('index.user.myNotice', ['item'=>'myNotice', 'notices'=>$notices]);
    }

    function noticeDesc(Request $request)
    {
        event(new getMsgCount());
        $id = $request->input('id');
        $notice = \DB::table('notices')->where('id', '=', $id)->first();
        \DB::table('notices')->where('id', '=', $id)->update(['is_read'=>1]);
        return view('index.user.noticeDesc', ['notice'=>$notice, 'item'=>'myNotice']);
    }

    function goodsOperation(Request $request)
    {
        $id = $request->input('id');
        $op_type = $request->input('op_type');
        switch ($op_type) {
            case 'up': $res = $this->upGoods($id);
                         break;
            case 'down': $res = $this->downGoods($id);
                         break;
            case 'del': $res = $this->delGoods($id);
        }
        return response()->json($res);
    }

    function editBaseData(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validateEditBaseData($request);
            $data = $request->input();
            unset($data['_token']);
            unset($data['file']);
            $user_data['alipay_account'] = $data['alipay_account'];
            $user_data['avatar'] = $data['avatar'];
            unset($data['alipay_account']);
            unset($data['avatar']);
            try {
                \DB::transaction(function () use ($data, $user_data) {
                    \DB::table('users')->update($user_data);
                    \DB::table('teams')->update($data);
                }, 3);
                return redirect(route('index.myprofile.baseData'));
            } catch (\Exception $e) {
                echo $e->getMessage();
            } catch (\Throwable $e) {
                echo $e->getMessage();
            }
        } elseif ($request->isMethod('get')) {
            $user_id = Auth::id();
            $user = \DB::table('users')->join('teams', 'teams.user_id', '=', 'users.id')->where(['users.id'=>$user_id])
                ->select('users.id as id', 'users.avatar', 'users.mobile', 'users.alipay_account', 'teams.id as team_id', 'teams.name', 'teams.qq', 'teams.weixin',
                    'teams.type', 'teams.income', 'teams.desc')->first();
            return view('index.user.editBaseData', ['user'=>$user, 'item'=>'baseData']);
        }

    }

    function validateEditBaseData(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|max:100',
            'qq' => 'digits_between:5,15',
            'weixin' => 'required|max:50',
            'income' => 'numeric',
            'desc' => 'max:1000'
        ]);
    }

    function uploadImg(Request $request)
    {
        $res = $request->file('file')->store('images');
        return response()->json($res);
    }

    function delMystar(Request $request)
    {
        $user_id = Auth::id();
        $goods_ids = $request->input('goods_ids');
        foreach ($goods_ids as $id) {
            \DB::table('star')->where(['user_id'=>$user_id, 'id'=>$id])->delete();
        }
        $res['status'] = true;
        $res['msg'] = '删除成功';
        return response()->json($res);
    }

    function test()
    {
        Star::destroy(['2158622785']);
    }

}

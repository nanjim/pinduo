<?php

namespace App\Http\Controllers\Auth;

use App\Http\Traits\SendMessage;
use App\Model\Index\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use SendMessage;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $messages = [
            'mobile.unique' => '该手机号已存在',
            'mobile.size' => '手机号格式有误',
            'mobile.required' => '请填写手机号',
            'password.required' => '请填写密码',
            'password.min' => '密码最小长度为6',
            'confirmed' => '两次密码输入不一致，请重新输入',
            'verify.required' => '验证码不能为空',
        ];
        return Validator::make($data, [
            'mobile' => 'bail|required|string|size:11|unique:users',
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
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $str="QWERTYUIOPASDFGHJKLZXCVB";
        $name = substr(str_shuffle($str),0,15);
        return User::create([
            'name' => $name,
            'mobile' => $data['mobile'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * $type 1:需要验证手机是否已注册
     */
    function sendMessage(Request $request)
    {

        $type = $request->input('type');
        $mobile = $request->input('mobile');

        if ($type == 1) {
            $user_id = \DB::table('users')->where('mobile', '=', $mobile)->value('id');
            if ($user_id) {
                $data['status'] = false;
                $data['msg'] = '该手机号已注册';
                return response()->json($data);
            }
        }

//        $data['status'] = true;
//        $data['vcode'] = 1234;
//        session(['vcode'=>1234]);
//        return response()->json($data);

        $res = $this->sendSMS($request);

        if ($res->Code == 'OK') {
            $data['status'] = true;
            $data['vcode'] = session('vcode');
        } else {
            $data['status'] = false;
            $data['msg'] = '短信发送失败，请稍后再试';
        }

        return response()->json($data);

    }
}

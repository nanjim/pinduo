<?php

namespace App\Http\Controllers\Index;

use App\lib\tools\FooBar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChargeController extends Controller
{
    function __construct()
    {
        $this->middleware('checkLogin')->except('test');

    }

    function charge()
    {
        $charge_sets = \DB::table('charge_sets')->get();
        return view('index.user.charge', ['item'=>'charge', 'charge_sets'=>$charge_sets]);
    }

    function postCharge(Request $request)
    {
        $data = $request->input();
        $alipay = app('alipay.web');
        $alipay->setOutTradeNo('123448941565456454');
        $alipay->setTotalFee($data['cny']);
        $alipay->setSubject('积分充值');
        $alipay->setBody('积分充值');
        $alipay->setQrPayMode('4');

        return redirect($alipay->getPaylink());
    }

    function test()
    {
        print_r(get_declared_classes());
    }
}

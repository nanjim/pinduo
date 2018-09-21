<?php

namespace App\Http\Traits;

use Mrgoon\AliSms\AliSms;

trait SendMessage {

    function sendSMS($request)
    {
        $mobile = $request->input('mobile');
        $code = rand(1000,9999);
        session(['vcode'=>$code]);
        $aliSms = new AliSms();
        $res = $aliSms->sendSms($mobile, 'SMS_143695150', ['code'=> $code]);
        return $res;
    }
}
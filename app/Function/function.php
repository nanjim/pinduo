<?php

/**
 * @Author: liiuchunlei
 * @Date:   2018-07-16 11:44:59
 * @Last Modified by:   Administrator
 * @Last Modified time: 2018-08-02 18:17:28
 */

use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Flc\Alidayu\Requests\IRequest;
function sendMessage()
{
	

	// 配置信息
	$config = [
	    'app_key'    => '*****',
	    'app_secret' => '************',
	];


	// 使用方法
	$client = new Client(new App($config));
	$req    = new AlibabaAliqinFcSmsNumSend;

	$req->setRecNum('13312311231')
	    ->setSmsParam([
	        'number' => rand(100000, 999999)
	    ])
	    ->setSmsFreeSignName('叶子坑')
	    ->setSmsTemplateCode('SMS_15105357');

	$resp = $client->execute($req);

	// 返回结果
	print_r($resp);
	print_r($resp->result->model);
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

function test()
{
	echo 123;
}
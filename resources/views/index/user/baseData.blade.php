@extends('index.layout.myprofile')
<?php error_reporting(E_ERROR);?>
@section('content')
<div class="myprofile-board">
	<i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料 <a href="{{route('index.baseData.edit')}}" style="color: #F1990B;cursor: pointer">
		@if($team_id > 0)
			<i class="fa fa-edit fa-fw text-edit"></i>编辑</a>
		@else
		123
		@endif
	<hr>
	<div>
		<span class="user-item col-md-2">团队名称：</span><span class="col-md-2">{{$user->name}}</span><br><br>
		<span class="user-item col-md-2">账号：</span><span class="col-md-2">{{$user->mobile}}</span><br><br>
		<span class="user-item col-md-2">QQ：</span><span class="col-md-2">{{$user->qq}}</span><br><br>
		<span class="user-item col-md-2">微信：</span><span class="col-md-2">{{$user->weixin}}</span><br><br>
		<span class="user-item col-md-2">月收入：</span><span class="col-md-2">{{$user->income}}</span><br><br>
		<span class="user-item col-md-2">团队介绍：</span><span class="col-md-2">{{$user->desc}}</span><br>
	</div>
</div>
@endsection

@extends('index.layout.myprofile')
<?php error_reporting(E_ERROR);?>

@section('style')
	@parent
	<link href="https://cdn.bootcss.com/webuploader/0.1.1/webuploader.css" rel="stylesheet">
	<style>
		.user-info #avatar img{
			height: 5rem;
			width: 5rem;
			border: 1px solid #FB9423;
			-webkit-border-radius: 50px;
			-moz-border-radius: 50px;
			border-radius: 50px;
		}
		.user-info #avatar {
			padding: 1rem;
		}
	</style>
@endsection

@section('content')
<div class="myprofile-board">
	<i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料 <a href="{{route('index.baseData.edit')}}" style="color: #F1990B;cursor: pointer"><i class="fa fa-edit fa-fw"></i>编辑</a>
	<hr>
	<div>
		<div class="card user-info">
			<div class="card-header">编辑资料</div>
			<div class="card-body">
				<form action="{{route('index.uploadImg')}}" method="post" enctype="multipart/form-data">
					{{csrf_field()}}
					<input type="file" name="file">

					<div class="text-center">
						<button type="submit" class="btn btn-orange">提交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('js')
	@parent

@endsection
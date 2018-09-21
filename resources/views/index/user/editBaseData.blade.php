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
	<i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料
	<hr>
	<div>
		<div class="card user-info">
			<div class="card-header">编辑资料</div>
			<div class="card-body">
				<form action="{{route('index.baseData.edit')}}" method="post">
					{{csrf_field()}}
					<div id="avatar" class="text-center">
						<div id="uploader-box">
							<div id="fileList" class="uploader-list"><img src="{{old('avatar') ? URL::asset('upload/'.old('avatar')) : URL::asset('upload/'.$user->avatar)}}" alt=""></div>
							<br>
							<div id="filePicker">修改头像</div>
						</div>
						<br>
					</div>
					<div class="form-group row">
						<div class="col-md-4 offset-3 text-center">
							<input type="radio" class="" name="type" value="1" checked {{old('type')==1 ? 'checked' : ''}}> 个人
						</div>
						<div class="col-md-4">
							<input type="radio" name="type" value="2" class="" {{old('type')==2 ? 'checked' : ''}}> 团队
						</div>
					</div>
					<br>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">个人/团队名称</label>
						<div class="col-md-4">
							<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('name') ?: $user->name}}">
							@if($errors->has('name'))
								<span class="invalid-feedback">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
							@endif
						</div>
					</div>
					<div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">QQ</label>
						<div class="col-md-4">
							<input type="text" name="qq" class="form-control{{ $errors->has('qq') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('qq') ?: $user->qq}}" >
							@if($errors->has('qq'))
								<span class="invalid-feedback">
                                    <strong>{{$errors->first('qq')}}</strong>
                                </span>
							@endif
						</div>
					</div>

					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">微信号</label>
						<div class="col-md-4">
							<input type="text" name="weixin" class="form-control{{ $errors->has('weixin') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('weixin') ?: $user->weixin}}">
							@if($errors->has('weixin'))
								<span class="invalid-feedback">
                                    <strong>{{$errors->first('weixin')}}</strong>
                                </span>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">支付宝账户</label>
						<div class="col-md-4">
							<input type="text" name="alipay_account" class="form-control{{ $errors->has('alipay_account') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('alipay_account') ?: $user->alipay_account}}">
							@if($errors->has('alipay_account'))
								<span class="invalid-feedback">
                                    <strong>{{$errors->first('alipay_account')}}</strong>
                                </span>
							@endif
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">月收入</label>
						<div class="col-md-2">
							<input type="text" name="income" class="form-control{{ $errors->has('income') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('income') ?: $user->income}}">
							@if($errors->has('income'))
								<span class="invalid-feedback">
                                    <strong>{{$errors->first('income')}}</strong>
                                </span>
							@endif
						</div>
						<div class="col-md-1 control-label">
							万
						</div>
					</div>
					<div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">个人/团队介绍</label>
						<div class="col-md-4">
							<textarea name="desc" cols="30" rows="5" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}">{{old('desc') ?: $user->desc}}</textarea>
							@if($errors->has('desc'))
								<span class="invalid-feedback">
                                    <strong>{{$errors->first('desc')}}</strong>
                                </span>
							@endif
						</div>
					</div>
					<input type="hidden" name="avatar" value="{{old('avatar') ?: $user->avatar}}">
					<br>
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
	<script src="https://cdn.bootcss.com/webuploader/0.1.1/webuploader.min.js"></script>
	<script>
        $(document).ready(function () {
            var $list = $('#fileList'),
                thumbnailWidth = 200,
                thumbnailHeight =200


            var uploader = WebUploader.create({

                // 选完文件后，是否自动上传。
                auto: true,

				formData: {
                  _token: '{{csrf_token()}}'
				},

                // 文件接收服务端。
                server: '{{route('index.uploadImg')}}',

                // 选择文件的按钮。可选。
                // 内部根据当前运行是创建，可能是input元素，也可能是flash.
                pick: {
                    id: '#filePicker',
					multiple: false,
				},

                // 只允许选择图片文件。
                accept: {
                    title: 'Images',
                    extensions: 'gif,jpg,jpeg,bmp,png',
                    mimeTypes: 'image/*'
                }
            });

            uploader.on( 'fileQueued', function( file ) {
                var $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '</div>'
                    ),
                    $img = $li.find('img');


                // $list为容器jQuery实例
                $list.html( $li );

                // 创建缩略图
                // 如果为非图片文件，可以不用调用此方法。
                // thumbnailWidth x thumbnailHeight 为 100 x 100
                uploader.makeThumb( file, function( error, src ) {
                    if ( error ) {
                        $img.replaceWith('<span>不能预览</span>');
                        return;
                    }

                    $img.attr( 'src', src );
                }, thumbnailWidth, thumbnailHeight );

            });

            // 文件上传过程中创建进度条实时显示。
            uploader.on( 'uploadProgress', function( file, percentage ) {
                var $li = $( '#'+file.id ),
                    $percent = $li.find('.progress span');

                // 避免重复创建
                if ( !$percent.length ) {
                    $percent = $('<p class="progress"><span></span></p>')
                        .appendTo( $li )
                        .find('span');
                }

                $percent.css( 'width', percentage * 100 + '%' );
            });

            // 文件上传成功，给item添加成功class, 用样式标记上传成功。
            uploader.on( 'uploadSuccess', function( file, res ) {
                console.log(res);
                $("input[name=avatar]").val(res);
                $( '#'+file.id ).addClass('upload-state-done');
            });

            // 文件上传失败，显示上传出错。
            uploader.on( 'uploadError', function( file, res ) {
                console.log(res);

                var $li = $( '#'+file.id ),
                    $error = $li.find('div.error');

                // 避免重复创建
                if ( !$error.length ) {
                    $error = $('<div class="error"></div>').appendTo( $li );
                }

                $error.text('上传失败');
            });

            // 完成上传完了，成功或者失败，先删除进度条。
            uploader.on( 'uploadComplete', function( file ) {
                $("#filePicker").hide();
                $( '#'+file.id ).find('.progress').remove();
            });

        });
	</script>
@endsection
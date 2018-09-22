
<?php error_reporting(E_ERROR);?>

<?php $__env->startSection('style'); ?>
	##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料
	<hr>
	<div>
		<div class="card user-info">
			<div class="card-header">编辑资料</div>
			<div class="card-body">
				<form action="<?php echo e(route('index.baseData.edit'), false); ?>" method="post">
					<?php echo e(csrf_field(), false); ?>

					<div id="avatar" class="text-center">
						<div id="uploader-box">
							<div id="fileList" class="uploader-list"><img src="<?php echo e(old('avatar') ? URL::asset('upload/'.old('avatar')) : URL::asset('upload/'.$user->avatar), false); ?>" alt=""></div>
							<br>
							<div id="filePicker">修改头像</div>
						</div>
						<br>
					</div>
					<div class="form-group row">
						<div class="col-md-4 offset-3 text-center">
							<input type="radio" class="" name="type" value="1" checked <?php echo e(old('type')==1 ? 'checked' : '', false); ?>> 个人
						</div>
						<div class="col-md-4">
							<input type="radio" name="type" value="2" class="" <?php echo e(old('type')==2 ? 'checked' : '', false); ?>> 团队
						</div>
					</div>
					<br>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">个人/团队名称</label>
						<div class="col-md-4">
							<input type="text" name="name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('name') ?: $user->name, false); ?>">
							<?php if($errors->has('name')): ?>
								<span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('name'), false); ?></strong>
                                </span>
							<?php endif; ?>
						</div>
					</div>
					<div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">QQ</label>
						<div class="col-md-4">
							<input type="text" name="qq" class="form-control<?php echo e($errors->has('qq') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('qq') ?: $user->qq, false); ?>" >
							<?php if($errors->has('qq')): ?>
								<span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('qq'), false); ?></strong>
                                </span>
							<?php endif; ?>
						</div>
					</div>

					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">微信号</label>
						<div class="col-md-4">
							<input type="text" name="weixin" class="form-control<?php echo e($errors->has('weixin') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('weixin') ?: $user->weixin, false); ?>">
							<?php if($errors->has('weixin')): ?>
								<span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('weixin'), false); ?></strong>
                                </span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">支付宝账户</label>
						<div class="col-md-4">
							<input type="text" name="alipay_account" class="form-control<?php echo e($errors->has('alipay_account') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('alipay_account') ?: $user->alipay_account, false); ?>">
							<?php if($errors->has('alipay_account')): ?>
								<span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('alipay_account'), false); ?></strong>
                                </span>
							<?php endif; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">月收入</label>
						<div class="col-md-2">
							<input type="text" name="income" class="form-control<?php echo e($errors->has('income') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('income') ?: $user->income, false); ?>">
							<?php if($errors->has('income')): ?>
								<span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('income'), false); ?></strong>
                                </span>
							<?php endif; ?>
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
							<textarea name="desc" cols="30" rows="5" class="form-control<?php echo e($errors->has('desc') ? ' is-invalid' : '', false); ?>"><?php echo e(old('desc') ?: $user->desc, false); ?></textarea>
							<?php if($errors->has('desc')): ?>
								<span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('desc'), false); ?></strong>
                                </span>
							<?php endif; ?>
						</div>
					</div>
					<input type="hidden" name="avatar" value="<?php echo e(old('avatar') ?: $user->avatar, false); ?>">
					<br>
					<div class="text-center">
						<button type="submit" class="btn btn-orange">提交</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
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
                  _token: '<?php echo e(csrf_token(), false); ?>'
				},

                // 文件接收服务端。
                server: '<?php echo e(route('index.uploadImg'), false); ?>',

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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
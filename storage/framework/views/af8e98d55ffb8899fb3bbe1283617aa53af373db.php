
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
	<i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料 <a href="<?php echo e(route('index.baseData.edit'), false); ?>" style="color: #F1990B;cursor: pointer"><i class="fa fa-edit fa-fw"></i>编辑</a>
	<hr>
	<div>
		<div class="card user-info">
			<div class="card-header">编辑资料</div>
			<div class="card-body">
				<form action="<?php echo e(route('index.uploadImg'), false); ?>" method="post" enctype="multipart/form-data">
					<?php echo e(csrf_field(), false); ?>

					<input type="file" name="file">

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
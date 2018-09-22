
<?php error_reporting(E_ERROR);?>
<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料
		<?php if($has_team): ?>
			<a href="<?php echo e(route('index.baseData.edit'), false); ?>" style="color: #F1990B;cursor: pointer"><i class="fa fa-edit fa-fw text-edit"></i>编辑</a>
		<?php endif; ?>
	<hr>
	<div>
		<span class="user-item col-md-2">团队名称：</span><span class="col-md-2"><?php echo e($user->name, false); ?></span><br><br>
		<span class="user-item col-md-2">账号：</span><span class="col-md-2"><?php echo e($user->mobile, false); ?></span><br><br>
		<span class="user-item col-md-2">QQ：</span><span class="col-md-2"><?php echo e($user->qq, false); ?></span><br><br>
		<span class="user-item col-md-2">微信：</span><span class="col-md-2"><?php echo e($user->weixin, false); ?></span><br><br>
		<span class="user-item col-md-2">月收入：</span><span class="col-md-2"><?php echo e($user->income, false); ?></span><br><br>
		<span class="user-item col-md-2">团队介绍：</span><span class="col-md-2"><?php echo e($user->desc, false); ?></span><br>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<i class="fa fa-camera-retro fa-fw"></i> 消息详情
	<hr>
	<div class="bg">
        <div class="notice-desc-box">
            <p class="notice-title"><?php echo e($notice->title, false); ?>

            </p>
            <hr>
            <p class="notice-desc"><?php echo e($notice->desc, false); ?></p>
            <p class="text-right text-muted"><?php echo e($notice->created_at, false); ?></p>
        </div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
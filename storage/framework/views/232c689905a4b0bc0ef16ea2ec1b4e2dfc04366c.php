

<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<i class="fa fa-camera-retro fa-fw"></i> 我的消息
	<hr>
	<div class="bg">
        <?php $__currentLoopData = $notices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('index.myprofile.noticeDesc', ['id'=>$notice->id]), false); ?>">
                <div class="notice-item">
                    <p class="notice-title"><?php echo e($notice->title, false); ?>

                        <?php if($notice->is_read == 0): ?>
                            <span class="badge badge-pill badge-danger pull-right">new</span>
                        <?php endif; ?>
                    </p>
                    <hr>
                    <p class="notice-desc"><?php echo e(mb_substr($notice->desc, 0, 180).'...', false); ?></p>
                    <p class="text-right text-muted"><?php echo e($notice->created_at, false); ?></p>
                </div>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
    <div class="links">
        <?php echo e($notices->links(), false); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
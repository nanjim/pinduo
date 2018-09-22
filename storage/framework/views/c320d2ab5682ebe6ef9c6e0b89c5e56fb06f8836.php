


<?php $__env->startSection('content'); ?>
<?php echo $__env->make('index.goods.cat', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('index.goods.sort', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="goods-container">
    <div id="goods-list" class="goods-list d-flex flex-wrap justify-content-around">
        <?php echo $__env->make('index.goods.goodsList',['data'=>$goodsList], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div><br>
    <div class="page text-center col-md-12">
        <?php echo e($goodsList->render(), false); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php error_reporting(E_ERROR);?>



<?php echo $__env->make('index.layout.entry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
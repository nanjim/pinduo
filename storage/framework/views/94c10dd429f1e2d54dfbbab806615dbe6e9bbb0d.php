<div class="search-wrap col-md-4 col-xs-12">
    <div class="logo">
        <a href="<?php echo e(route('mobile.index.index', ['user_id'=>session('user_id')]), false); ?>"><img src="/img/site/huimaike.png" alt=""></a>
    </div>
    <div class="search-input-box">
        <form id="search-form" action="<?php echo e(route('mobile.index.search'), false); ?>">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="搜索关键字或标题" name="q" value="<?php echo e(isset($querys['q']) ? $querys['q'] : '', false); ?>">
        </form>
    </div>
</div>
<div class="sort col-md-4 col-xs-12">

    <a href="<?php echo e(route('mobile.index.search', array_merge($querys, ['sort'=>0])), false); ?>"><div class="sort-item sum "><span class=<?php echo e(!isset($querys['sort']) || $querys['sort']==0 ? 'def' : '', false); ?>>综合</span></div></a>

    <a href="<?php echo e(route('mobile.index.search', array_merge($querys, ['sort'=>8])), false); ?>"><div class="sort-item disc"><span class=<?php echo e(isset($querys['sort']) && $querys['sort']==8 ? 'def' : '', false); ?>>实惠</span></div></a>

    <a href="<?php echo e(route('mobile.index.search', array_merge($querys, ['sort'=>6])), false); ?>"><div class="sort-item sale"><span class=<?php echo e(isset($querys['sort']) && $querys['sort']==6 ? 'def' : '', false); ?>>销量</span></div></a>

    <?php if(isset($querys['sort']) && ($querys['sort']==3 || $querys['sort']==4)): ?>
        <a href="<?php echo e(route('mobile.index.search', array_merge($querys, ['sort'=>12/$querys['sort']])), false); ?>"><div class="sort-item price"><span class="def">价格</span></div></a>
    <?php else: ?>
        <a href="<?php echo e(route('mobile.index.search', array_merge($querys, ['sort'=>3])), false); ?>"><div class="sort-item price"><span>价格</span></div></a>
    <?php endif; ?>

</div>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
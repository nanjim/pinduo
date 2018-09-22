<div class="search-wrap">
    <div class="logo">
        <img src="/img/site/huimaike.png" alt="">
    </div>
    <div class="search-input-box">
        <form id="search-form" action="<?php echo e(route('mobile.index.search'), false); ?>">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="搜索关键字或标题" name="q">
        </form>
    </div>
</div>
<div class="cats col-md-4 col-xs-12">
    <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(isset($querys['cat_id']) && $querys['cat_id']==$cat->id): ?>
            <a href="<?php echo e(route('mobile.index.index', ['cat_id'=>$cat->id]), false); ?>"><div class="cat-item"><span class="def"><?php echo e($cat->mobile_name, false); ?></span></div></a>
        <?php else: ?>
            <a href="<?php echo e(route('mobile.index.index', ['cat_id'=>$cat->id]), false); ?>"><div class="cat-item"><span><?php echo e($cat->mobile_name, false); ?></span></div></a>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<div class="flash">
    <div class="swiper-wrapper">
        <?php $__currentLoopData = $flashs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide"><a href="<?php echo e($flash->link, false); ?>"><img src="<?php echo e(URL::asset('upload/'.$flash->img_url), false); ?>" class="banner" alt="" /></a></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<div class="sort">

    <a href="<?php echo e(route('mobile.index.index', array_merge($querys, ['sort'=>0])), false); ?>"><div class="sort-item sum "><span class=<?php echo e(!isset($querys['sort']) || $querys['sort']==0 ? 'def' : '', false); ?>>综合</span></div></a>

    <a href="<?php echo e(route('mobile.index.index', array_merge($querys, ['sort'=>8])), false); ?>"><div class="sort-item disc"><span class=<?php echo e(isset($querys['sort']) && $querys['sort']==8 ? 'def' : '', false); ?>>实惠</span></div></a>

    <a href="<?php echo e(route('mobile.index.index', array_merge($querys, ['sort'=>6])), false); ?>"><div class="sort-item sale"><span class=<?php echo e(isset($querys['sort']) && $querys['sort']==6 ? 'def' : '', false); ?>>销量</span></div></a>

    <?php if(isset($querys['sort']) && ($querys['sort']==3 || $querys['sort']==4)): ?>
        <a href="<?php echo e(route('mobile.index.index', array_merge($querys, ['sort'=>12/$querys['sort']])), false); ?>"><div class="sort-item price"><span class="def">价格</span></div></a>
    <?php else: ?>
        <a href="<?php echo e(route('mobile.index.index', array_merge($querys, ['sort'=>3])), false); ?>"><div class="sort-item price"><span>价格</span></div></a>
    <?php endif; ?>

</div>
<?php $__env->startSection('js'); ?>
    <script>
        var mySwiper = new Swiper('.flash', {
            autoplay: true,//可选选项，自动滑动
            pagination: {
                el: '.swiper-pagination',
            },
        });
    </script>
<?php $__env->stopSection(); ?>
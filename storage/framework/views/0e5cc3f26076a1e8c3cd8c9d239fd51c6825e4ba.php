<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale()), false); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title><?php echo e(isset($title) ? $title : '', false); ?></title>

    <!-- Styles -->
    <link href="https://cdn.bootcss.com/Swiper/4.3.0/css/swiper.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css'), false); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/mobile/mobile.css'), false); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('js/plugins/mescroll/dist/mescroll.min.css'), false); ?>">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php $__env->startSection('style'); ?>

    <?php echo $__env->yieldSection(); ?>
</head>

<body>
    <div id="wrap" class="col-md-4 col-md-offset-4 ">
        <div id="list" class="mescroll">
            <?php echo $__env->make('mobile.layout.top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <i id="toTop" class="fa fa-arrow-circle-up toTop"></i>
</body>
<!-- Scripts -->
<script src="https://cdn.bootcss.com/vue/2.2.2/vue.min.js"></script>
<script src="<?php echo e(asset('js/app.js'), false); ?>" defer></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script src="<?php echo e(asset('js/scrollToTop.js'), false); ?>"></script>
<script src="<?php echo e(asset('js/bootstrap.min.js'), false); ?>"></script>
<script src="<?php echo e(asset('js/plugins/mescroll/dist/mescroll.min.js'), false); ?>"></script>
<script src="https://cdn.bootcss.com/Swiper/4.3.0/js/swiper.min.js"></script>
<script>
</script>
<?php $__env->startSection('js'); ?>

<?php echo $__env->yieldSection(); ?>
</html>



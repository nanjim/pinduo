<?php error_reporting(E_ERROR|E_CORE_WARNING);?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale()), false); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token(), false); ?>">

    <title><?php echo e(config('app.name', '惠麦客'), false); ?></title>

    <!-- Styles -->
    <?php $__env->startSection('style'); ?>
        <link href="<?php echo e(asset('css/app.css'), false); ?>" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(URL::asset('css/main.css'), false); ?>">
        <link rel="stylesheet" href="<?php echo e(URL::asset('css/foot.css'), false); ?>">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <?php echo $__env->yieldSection(); ?>
</head>
<style>


</style>
<body>
        
    <div id="wrap">
        <?php echo $__env->make('index.layout.entry_header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <?php echo $__env->make('index.layout.foot', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div>
    <i id="toTop" class="fa fa-arrow-circle-up toTop"></i>
    <i v-on:click="star()" id="star-box" class="fa fa-star-o star-box"></i>
</body>
<!-- Scripts -->
<script src="https://cdn.bootcss.com/vue/2.2.2/vue.min.js"></script>
<script src="<?php echo e(asset('js/app.js'), false); ?>" defer></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>

<script src="<?php echo e(asset('js/main.js'), false); ?>"></script>
<script src="<?php echo e(asset('js/scrollToTop.js'), false); ?>"></script>
<script>

    var topElement = document.getElementById("toTop");

    var toTop = new ScrollToTop(topElement, {
        showWhen: 1500,
        speed: 500
    })

    var goods = new Vue({
        el: '#goods-list',
        methods: {
            star: function(event){
                var id = event.target.dataset.id;
                var url = "/user/star/"+id;
                $.ajax({
                    type:"get",
                    url:url,
                    success:function(res){
                        $data = JSON.parse(res);
                        if($data['status']){
                            if($data['is_exist']){
                                layer.alert('已收藏',{icon:5});
                            }else{
                                layer.alert('收藏成功',{icon:1});
                            }
                        }else{
                            location.href = "<?php echo e(url('/login'), false); ?>";
                        }
                    }
                });
            }
        }
    })
    
</script>
<?php $__env->startSection('js'); ?>

<?php echo $__env->yieldSection(); ?>
</html>



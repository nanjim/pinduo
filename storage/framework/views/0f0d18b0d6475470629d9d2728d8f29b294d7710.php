

<div class="flash swiper-container">
    <div class="swiper-wrapper">
        <?php $__currentLoopData = $flashs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $flash): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="swiper-slide"><a href="<?php echo e($flash->link, false); ?>"><img src="<?php echo e(URL::asset($flash->img_url), false); ?>" class="banner" alt="" /></a></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="swiper-pagination"></div>
</div>


    <script>
        $(document).ready(function () {
            var swiper = new Swiper('.swiper-container', {
                pagination: {
                    el: '.swiper-pagination',
                },
            });
            document.onkeydown = function () {
                var theEvent = window.event;
                var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
                if (code == 13) {
                    $("#search-form").submit();
                    return false;
                }
                return true;
            }
        });
    </script>
<?php echo $__env->make('mobile.layout.test, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
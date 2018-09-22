

<?php $__env->startSection('content'); ?>
<div class="content-wrap">

        <div class="list-item">

        </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
    <script src="https://cdn.bootcss.com/Swiper/4.3.0/js/swiper.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            pagination: {
                el: '.swiper-pagination',
            },
        });

        $(document).ready(function () {
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

        var mescroll = new MeScroll('list',{
            down:{
                isLock:true,
            },
            up:{
                callback:upCallback,
                isBounce: false,
                page:{'num':0,'size':10}
            }
        });

        function upCallback(page){
            var url = "<?php echo e(route('mobile.index.goods'), false); ?>";
            var sort = "<?php echo e(isset($querys['sort']) ? $querys['sort'] : 0, false); ?>";
            var cat_id = "<?php echo e(isset($querys['cat_id']) ? $querys['cat_id'] : 1, false); ?>";
            $.ajax({
                type:"get",
                url: url,
                data:{'num':page.num,'size':page.size,'sort':sort,'cat_id':cat_id},
                success: function(data) {
                    mescroll.endBySize(data.length, data.total_size);
                    setListData(data.goods_list);
                },
                error: function(data) {
                    //联网失败的回调,隐藏下拉刷新的状态
                    mescroll.endErr();
                },

            });

        }

        function setListData(data){
            for(var i=0;i<data.length;i++){
                var goods = '<div class="goods-item item-6"><div class="goods-inner-item"><a class="goods-item-a" target="_blank" href="http://mobile.yangkeduo.com/goods2.html?goods_id='+data[i].goods_id+'">' +
                                '<img src="'+data[i].goods_thumbnail_url+'">' +
                                '<div class="goods-title"><span>' + data[i].goods_name.substr(0,20) + '</span></div>' +
                                '<p><span class="after-price">￥' + ((data[i].min_group_price-data[i].coupon_discount)/100) + '</span>' +
                                '<s class="origin-price">￥' + (data[i].min_group_price/100) + '</s></p>' +
                                '<p><span class="coupon">' + data[i].coupon_discount/100 + '元优惠券</span>' +
                                '<span class="sale">销量' + data[i].sold_quantity + '</span></p>' +
                                '</a>' +
                            '</div></div>';
                $(".list-item").append(goods);
            }
        }
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('mobile.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
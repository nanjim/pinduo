

<?php $__env->startSection('style'); ?>
    ##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
    <style>
        .user-info {
            background: #FAA950;
            height: 13rem;
            color: white;
            padding: 2rem;
        }
        .user-info img{
            width: 5rem;
            height: 5rem;
            border: solid #F8AB65;
            -webkit-border-radius: 50px;
            -moz-border-radius: 50px;
            border-radius: 50px;
        }
        .user-type {
            background: #FD6310;
            color: white;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            padding: 0.25rem 0.5rem;
            text-align: center;
            margin-left: 0.5rem;
        }
        .user-name {
            font-size: 18px;
        }
        .right-info {
            position: absolute;
            right: 0.5rem;
            width: 10rem;
            text-align: left;
            font-size: 18px;
        }
        .hidden {
            display: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="user-info">
    <div class="right-info">
        入驻时间 <span style="color: #FD6310"><?php echo e((int)((time() - strtotime($data['team']->created_at))/86400 + 1), false); ?></span> &nbsp;天
        <br>
        在线商品 <span style="color: #FD6310;"><?php echo e($data['goodsCount'], false); ?></span> &nbsp;件
    </div>
    <div class="text-center">
        <img src="<?php echo e(URL::asset('upload/'.$data['avatar']), false); ?>" alt="">
        <br><br>
        <span class="user-name"><?php echo e($data['team']->name, false); ?></span> &nbsp;<span class="user-type"><?php echo e($data['team']->type == 1 ? '个人' : '团队', false); ?></span>
    </div>
</div>
<div class="goods-container">
    <div id="goods-list" class="goods-list d-flex flex-wrap justify-content-around">
    <?php $__currentLoopData = $data['goods_list']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="goods-item card goods-box" data-id="<?php echo e($goods->goods_id, false); ?>">
            <div class="card-body">
                <a class="goods-img" href="<?php echo e(route('goods.detail', ['id'=>$goods->goods_id]), false); ?>" target="_blank">
                    <img src="<?php echo e(URL::asset($goods->main_img), false); ?>" alt="">
                </a>
                <span class="star"><i v-on:click="star($event)" data-id="<?php echo e($goods->goods_id, false); ?>" class="fa fa-star-o star-icon"></i></span>
                <div class="goods-item goods-name">
                    <?php echo e(mb_substr($goods->title,0,30), false); ?>

                </div>
                <div class="commission row goods-item">
                    <div class="jin col-md-6 border border-top-0 border-left-0 border-bottom-0">
                        <div class="text-center">￥<?php echo e($goods->commission, false); ?></div>
                        <div class="text-center"><i class="fa fa-money" aria-hidden="true"></i> 佣金</div>
                    </div>
                    <div class="plan col-md-6">
                        <div class="text-center"><?php echo e($goods->rate, false); ?>%</div>
                        <div class="text-center"><i class="fa fa-btc" aria-hidden="true"></i> 计划</div>
                    </div>
                </div>
                <div class="coupon-msg goods-item">
                    <span>
                        <i class="fa fa-ticket" aria-hidden="true"></i> ￥<?php echo e($goods->coupon_amount, false); ?>

                    </span>
                    <span class="pull-right">
                        余<?php echo e($goods->coupon_remain, false); ?>

                    </span>
                    <div class="progress" style="height: 3px">
                        <div class="progress-bar" style="width:<?php echo e($goods->coupon_num > 0 ? ($goods->coupon_num-$goods->coupon_remain)/$goods->coupon_num*100 : 0, false); ?>%;">
                        </div>
                    </div>
                </div>
                <div class="price goods-item">
                    <span style="color: #8D8D8D;"><span>原价</span><s>￥<?php echo e($goods->origin_price, false); ?></s></span><br>
                    <span>券后</span>￥<?php echo e($goods->after_price, false); ?>

                <!-- <span><button>复制文案</button></span> -->
                    <span class="pull-right">销量<?php echo e($goods->sale_num, false); ?></span>
                </div>
                <?php if($goods->type == 0): ?>
                    <br>
                    <div class="text-center"><button data-toggle="tooltip" title="推荐：<?php echo e($goods->copy_text, false); ?>" data-clipboard-target="#copy-text" class="btn btn-orange btn-copy">复制文案</button></div>
                    <div class="copy-area">
                        <?php echo e($goods->copy_text, false); ?>

                    </div>
                <?php endif; ?>
            </div>
            <div id="copy-text" class="copy_text hidden">
                推荐：<?php echo e($goods->copy_text, false); ?>

            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
    <script src="https://cdn.bootcss.com/clipboard.js/2.0.1/clipboard.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            var clipboard = new ClipboardJS('.btn-copy', {
                'text': function (trigger) {
                    tar = trigger.parentNode.nextSibling.nextSibling.innerHTML;
                    return tar;
                }
            });
            clipboard.on('success',function(e) {
                e.clearSelection();
                if (e.trigger.disabled == false || e.trigger.disabled == undefined) {
                    e.trigger.innerHTML = "复制成功";
                    e.trigger.style.backgroundColor = "#9ED29E";
                    e.trigger.style.borderColor = "#9ED29E";
                    e.trigger.disabled = true;
                    setTimeout(function() {
                            e.trigger.innerHTML = "复制文案";
                            e.trigger.style.backgroundColor = "#FB8A05";
                            e.trigger.style.borderColor = "#FB8A05";
                            e.trigger.disabled = false;
                        },
                        2000);
                }
            });
        });
        $(document).on('mouseover', '.goods-box', function () {
            $copy_board = $(this).find('.copy_text');
            $copy_board.removeClass('hidden');
            $(this).css({'border-radius': '5px 5px 0 0', 'border': '1px solid orange', 'border-bottom': 'none'});
            $copy_board.css({'border': '1px solid orange', 'border-top': '1px solid #E9E9E9', 'border-radius': '0 0 5px 5px'});
        });
        $(document).on('mouseout', '.goods-box', function () {
            $copy_board = $(this).find('.copy_text');
            $copy_board.addClass('hidden');
            $(this).css({'border-radius': '5px', 'border': '1px solid #E8E6E6'});
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.entry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
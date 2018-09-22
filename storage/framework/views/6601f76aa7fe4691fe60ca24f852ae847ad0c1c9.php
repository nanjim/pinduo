

<?php $__env->startSection('style'); ?>
	##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
	<style>
		.star-list {
			border: 1px solid #E5E5E5;
			padding-bottom: 2rem;
		}
		.star-item {
			margin-top: 2rem;
			margin-left: 2rem;
			width: 45%;
			padding: 1rem;
			border: 1px solid #E5E5E5;
		}
		.goods-img {
		}
		.goods-info {
		}
		.row {
			padding: 0.5rem;
		}
		.star-item img {
			width: 100%;
		}
		.goods-info {
			margin-left: 0.5rem;
		}
		.col-7, .col-4 {
			padding: 0;
		}
		.text-lg {
			font-size: 18px;
		}
		.text-sm {
			font-size: 12px;
		}
	</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<i class="fa fa-camera-retro fa-fw"></i> 全部收藏
	<hr>
	<?php if(empty($stars)): ?>
		<div class="text-muted text-center">暂未有收藏商品</div>
	<?php else: ?>
	<div class="" style="">
		<button class="pull-right btn btn-orange btn-clear"   style="margin-left: 1rem">清空</button>
		<button class="pull-right btn btn-default btn-del">删除</button>
	</div>
	<br>
	<br>
	<div>
		<div class="star-list d-flex flex-wrap justify-content-start">
			<?php $__currentLoopData = $stars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $star): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="star-item row">
					<div class="" style="height: 2rem;width: 100%" data-goods_id="<?php echo e($star->id, false); ?>">
						<input name="star" type="checkbox" style="font-size: 30px;">
					</div>
					<div class="goods-img col-4">
						<a href="<?php echo e(route('goods.detail', ['id'=>$star->goods_id]), false); ?>">
							<img src="<?php echo e($star->main_img, false); ?>" alt="">
						</a>
					</div>
					<div class="pull-left goods-info col-7">
						<span class="text-muted">  <?php echo e(strlen($star->title) < 16 ? $star->title : mb_substr($star->title, 0, 16).'...', false); ?></span><br>
						<span class="text-red text-lg"><?php echo e('￥'.$star->after_price, false); ?></span>
						<s class="text-muted"><?php echo e('￥'.$star->origin_price, false); ?></s>
						<span class="text-muted pull-right text-sm">销量<?php echo e($star->sale_num, false); ?></span>
						<div class="commission row goods-item text-sm">
							<div class="jin col-md-6 border border-top-0 border-left-0 border-bottom-0">
								<div class="text-center">￥<?php echo e($star->commission, false); ?></div>
								<div class="text-center"><i class="fa fa-money" aria-hidden="true"></i> 佣金</div>
							</div>
							<div class="plan col-md-6 text-sm">
								<div class="text-center"><?php echo e($star->rate, false); ?>%</div>
								<div class="text-center"><i class="fa fa-btc" aria-hidden="true"></i> 计划</div>
							</div>
						</div>
						<div class="coupon-msg goods-item">
							<span>
								<i class="fa fa-ticket" aria-hidden="true"></i> ￥<?php echo e($star->coupon_amount, false); ?>

							</span>
										<span class="pull-right">
								余<?php echo e($star->coupon_remain, false); ?>

							</span>
							<div class="progress" style="height: 3px">
								<div class="progress-bar" style="width:<?php echo e($star->coupon_num > 0 ? ($star->coupon_num-$star->coupon_remain)/$star->coupon_num*100 : 0, false); ?>%;">
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
	<?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
	<script>
		$(document).ready(function () {
            $(".btn-del").click(function () {
                var goods_ids = [];
                $('input[name=star]:checked').each(function () {
                    goods_ids.push($(this).parent().data('goods_id'));
                });
                var sure = confirm('确定删除吗？');
                if (sure) {
                    $.ajax({
                        type: 'post',
                        url: "<?php echo e(route('index.star.del'), false); ?>",
                        data: {'goods_ids': goods_ids, '_token': "<?php echo e(csrf_token(), false); ?>"},
                        success: function (res) {
                            if (res.status) {
                                alert(res.msg);
                                location.reload();
                            }
                        }
                    });
				}
            });

            $('.btn-clear').click(function () {
				var sure = confirm('确定清空吗？');
				if (sure) {
                    $.ajax({
                        type: 'get',
                        url: '<?php echo e(route('index.star.clear'), false); ?>',
                        success: function (res) {
                            if (res.status) {
                                alert(res.msg);
                                location.reload();
                            }
                        }
                    });
				}
            });
        });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
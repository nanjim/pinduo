<?php $__env->startSection('style'); ?>
##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
	<style>
		.detail-container {
			padding: 2rem 2rem;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="detail-container d-flex flex-wrap justify-content-around"> 

			<div class="card col-md-2 align-self-start">
				<div class="card-body ">
				</div>
			</div>
			<div class="card col-md-9">
				<div class="card-body ">
					<i class="fa fa-cube" aria-hidden="true"></i><span>商品详情</span>
					<hr>
					<div class="row">			
						<div class="col-md-5 align-self-start">
							<div class="goods-img">
								<img src="<?php echo e($data->goods_thumbnail_url, false); ?>" alt="">
							</div>
							<p></p>
							<div class="goods-imgs d-flex flex-wrap ">
								<?php $__currentLoopData = $data->goods_gallery_urls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<img class="goods-img-thumb" src="<?php echo e($url, false); ?>" alt="">
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						</div>
						<div class="col-md-7">
							<div class="goods_name">
								<p>
									<?php echo e($data->goods_name, false); ?>

								</p>
							</div>
							<div>
								<p>
									<span class="col-md-4">
										<span class="text-dark small-1">
											券后
										</span>
										<span class="text-red large-1">
											￥<?php echo e(($data->min_group_price-$data->coupon_discount)/100, false); ?>

										</span>
									</span>
									<span class="col-md-3">
										原价<s class="price">￥<?php echo e($data->min_group_price/100, false); ?></s>
									</span>
									<span class="sales text-mute col-md-2">销量<?php echo e($data->sold_quantity, false); ?></span>
									<span class="score large-2 text-red col-md-3"><?php echo e($data->avg_desc, false); ?>分</span>
								</p>
							</div>
							<p class="solid"></p>
							<p class="row text-center">
								<span class="col-md-4">
									<span class="shit rounded">券</span>
									<span class="shit-amount text-red">￥<?php echo e($data->coupon_discount/100, false); ?></span></span>
								<span class="col-md-4">佣金
									<span class="text-red">￥<?php echo e((($data->min_group_price-$data->coupon_discount)*$data->promotion_rate)/100000, false); ?></span>
								</span>
								<span class="col-md-4">计划<?php echo e($data->promotion_rate/10, false); ?>%</span>
							</p>
							<p class="solid"></p>

								<p>
									<span>已领
										<span class="text-red"><?php echo e($data->coupon_total_quantity-$data->coupon_remain_quantity, false); ?></span>/<?php echo e($data->coupon_total_quantity, false); ?>

									</span>张
								</p>
								<p>
									<span>优惠券有效时间 <?php echo e(date('Y-m-d',$data->coupon_start_time), false); ?> 至 <?php echo e(date('Y-m-d',$data->coupon_end_time), false); ?>

									</span>
								</p>
							<p class="dashed"></p>
							<p>
								<?php echo e($data->goods_desc, false); ?>

							</p>
							<p>
								下单链接：<a id="link" target="_blank" href="http://mobile.yangkeduo.com/goods2.html?goods_id=<?php echo e($goods_id, false); ?>">http://mobile.yangkeduo.com/goods2.html?goods_id=<?php echo e($goods_id, false); ?></a>
							</p>
							<p class="text-center"><button class="btn btn-success trans-link-btn">一键转链</button></p>
						</div>
					</div>
				</div>
			</div>

	</div>
	
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
<script>
	$(function(){

		$(".goods-img-thumb").hover(function(){
			$(this).css('border',"solid green");
			var src = $(this).attr('src');
			$('.goods-img img').attr('src',src);
		},function(){
			$(this).css('border',"none");
		});

		$(".trans-link-btn").click(function () {
		    alert(123);
        });
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
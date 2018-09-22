<?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			
	<div class="card goods" data-id="<?php echo e($item->goods_id, false); ?>">
		<div class="card-body">
			<a class="goods-img" href="<?php echo e(route('goods.detail',['id'=>$item->goods_id]), false); ?>" target="_blank">
				<img src="<?php echo e($item->goods_thumbnail_url, false); ?>" alt="">
			</a>
			<span class="star"><i v-on:click="star($event)" data-id="<?php echo e($item->goods_id, false); ?>" class="fa fa-star-o star-icon"></i></span>
			<div class="goods-item goods-name">
				<?php echo e(mb_substr($item->goods_name,0,30), false); ?>

			</div>
			<div class="commission row goods-item">
				<div class="jin col-md-6 border border-top-0 border-left-0 border-bottom-0">
					<div class="text-center">￥<?php echo e(round(($item->min_group_price-$item->coupon_discount)/100*$item->promotion_rate/1000,2), false); ?></div>
					<div class="text-center"><i class="fa fa-money" aria-hidden="true"></i> 佣金</div>
				</div>
				<div class="plan col-md-6">
					<div class="text-center"><?php echo e($item->promotion_rate/10, false); ?>%</div>
					<div class="text-center"><i class="fa fa-btc" aria-hidden="true"></i> 计划</div>
				</div>
			</div>
			<div class="coupon-msg goods-item">
				<span>
					<i class="fa fa-ticket" aria-hidden="true"></i> ￥<?php echo e($item->coupon_discount/100, false); ?>

				</span>
				<span class="pull-right">
					余<?php echo e($item->coupon_remain_quantity > 0 ?: 0, false); ?>/<?php echo e($item->coupon_total_quantity ?: 0, false); ?>

				</span>
				<div class="progress" style="height: 3px">
			    	<div class="progress-bar" style="width:<?php echo e($item->coupon_total_quantity > 0 ? ($item->coupon_total_quantity-$item->coupon_remain_quantity)/$item->coupon_total_quantity*100 : 0, false); ?>%;">
			    	</div>
			  	</div>
			</div>
			<div class="price goods-item">
				<span>券后</span>￥<?php echo e(($item->min_group_price-$item->coupon_discount)/100, false); ?> 
				<!-- <span><button>复制文案</button></span> -->
				<span class="pull-right">销量<?php echo e($item->sold_quantity, false); ?></span>
			</div>
			
		</div>
		<!-- <div class="goods-item goods-desc card-footer rounded-bottom">
				dsadasds
		</div> -->
	</div>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




<?php $__env->startSection('style'); ?>
##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
	<style>
		.goods-owner-box {
			padding: 0;
		}
		.goods-owner {
			padding: 1rem 0 0 0;
		}
		.detail-container {
			padding: 2rem 2rem;
		}
		.goods-owner img{
			width: 5rem;
			height: 5rem;
			border: solid #F8AB65;
			-webkit-border-radius: 50px;
			-moz-border-radius: 50px;
			border-radius: 50px;
		}
		.team-type {
			background: #F8AB65;
			color: white;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			padding: 0.15rem;
			margin-left: 0.5rem;
		}
		.owner-name {
			font-weight: 600;
		}
		.owner-bottom {
			background: #E5E5E5;
			border-top: 1px solid #C0C0C0;
			height: 3rem;
		}
		.owner-bottom .item {
			width: 50%;
			float: left;
			text-align: center;
			padding: 0.3rem;
			height: 100%;
			font-size: 12px;
		}
		.owner-bottom .right {
			border-left: 1px solid #C0C0C0;
		}

	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
	<div class="detail-container d-flex flex-wrap justify-content-around"> 

			<?php if(isset($team)): ?>
                <div class="card col-md-2 align-self-start goods-owner-box">
                    <div class="card-body text-center goods-owner">
						<a href="<?php echo e(route('index.team_show', ['user_id'=>$team->user_id]), false); ?>"><img src="<?php echo e(URL::asset('upload/'.$team->avatar), false); ?>" alt=""></a>
                        <br><br>
                        <span class="owner-name"><?php echo e($team->name, false); ?></span><span class="team-type"><?php echo e($team->type == 1 ? '个人' : '团队', false); ?></span>
						<br><br>
						<div class="owner-bottom">
							<div class="item">
								入驻时间
								<br>
								<?php echo e((int)((time() - strtotime($team->created_at))/86400 + 1), false); ?> &nbsp;天
							</div>
							<div class="item right">
								在线商品
								<br>
								<?php echo e($team->goodsCount, false); ?> &nbsp;件
							</div>
						</div>
                    </div>

                </div>
            <?php endif; ?>
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

		$('.goods-img-thumb').hover(function(){
			$(this).css('border',"solid green");
			var src = $(this).attr('src');
			$('.goods-img img').attr('src',src);
		},function(){
			$(this).css('border',"none");
		});

		$(".trans-link-btn").click(function () {
		    var btn = $(this);
		    var link = $('#link').text();
		    $.ajax({
				type: "get",
				url: '<?php echo e(route('index.shortlink'), false); ?>',
				data: {'link': link},
				success:function (res) {
					console.log(res);
					$('#link').text(res);
					btn.hide();
                }
			});
        });
	})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.entry', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
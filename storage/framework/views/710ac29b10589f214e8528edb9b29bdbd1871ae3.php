

<?php $__env->startSection('style'); ?>
	##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
	<style>
		.usergoods-container {
			background: #F7F7F7;
		}
		.usergoods-container-inner {
			background: white;
			border: 1px solid #E9E9E9;
		}
		.usergoods-container-inner img {
			width: 7rem;
			height: 7rem;
		}
		.usergoods-item {
			height: 8rem;
			padding: 0.5rem;
			border-top: 1px solid #E9E9E9;
		}
		.usergoods-header span {
			float: left;
			width: 6rem;
			list-style: none;
			text-align: center;
			margin-left: 0.25rem;
		}
		.usergoods-header {
			height: 3rem;
			line-height: 2.8rem;
			background: white;
		}
		.usergoods-container .goods-info {
			line-height: 7rem;
		}
		.usergoods-container .goods-info span {
			text-align: center;
			width: 6rem;
			display: inline-block;
		}
		.usergoods-container .img-box {
			overflow: hidden;
			width: 7rem;
			display: inline;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<i class="fa fa-shopping-bag fa-fw"></i>&nbsp; 商品管理
	<hr>
	<div>
		<a href="<?php echo e(route('index.myprofile.merchandiseManage', ['show_type'=>0]), false); ?>">
			<button class="btn <?php echo e($show_type==0 ? 'btn-orange' : '', false); ?>">全部</button>
		</a>
		<a href="<?php echo e(route('index.myprofile.merchandiseManage', ['show_type'=>1]), false); ?>">
			<button class="btn <?php echo e($show_type==1 ? 'btn-orange' : '', false); ?>">已展示</button>
		</a>
		<a href="<?php echo e(route('index.myprofile.merchandiseManage', ['show_type'=>2]), false); ?>">
			<button class="btn <?php echo e($show_type==2 ? 'btn-orange' : '', false); ?>">待审核</button>
		</a>
		<a href="<?php echo e(route('index.myprofile.merchandiseManage', ['show_type'=>3]), false); ?>">
			<button class="btn <?php echo e($show_type==3 ? 'btn-orange' : '', false); ?>">已下架</button>
		</a>
		<a href="<?php echo e(route('index.myprofile.merchandiseManage', ['show_type'=>4]), false); ?>">
			<button class="btn <?php echo e($show_type==4 ? 'btn-orange' : '', false); ?>">已拒绝</button>
		</a>
	</div>
	<br>
	<div class="usergoods-container">
		<div class="usergoods-container-inner">
			<div class="usergoods-header">
					<span style="width: 7.5rem;">图片</span>
					<span>标题</span>
					<span>上架</span>
					<span>销量</span>
					<span>原价</span>
					<span>券后价</span>
					<span>优惠券</span>
					<span>计划</span>
					<span>操作</span>
			</div>
			<?php $__currentLoopData = $user_goods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goods): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="usergoods-item">
					<div class=" goods-info">
						<a href="<?php echo e(route('goods.detail', ['id'=>$goods->goods_id]), false); ?>"><img src="<?php echo e($goods->main_img, false); ?>" alt=""></a>
						<span style="width: 6rem;"><?php echo e(mb_substr($goods->title, 0, 4).'...', false); ?></span>
						<span><?php echo e($goods->onsale ? '是' : '否', false); ?></span>
						<span><?php echo e($goods->sale_num, false); ?></span>
						<span><?php echo e($goods->origin_price, false); ?></span>
						<span><?php echo e($goods->after_price, false); ?></span>
						<span><?php echo e($goods->coupon_amount, false); ?></span>
						<span><?php echo e($goods->rate, false); ?></span>
						<span>
							<?php if($goods->status == 1): ?>
								<?php if($goods->onsale == 1): ?>
									<button class="btn-sm btn-orange btn-op" data-id="<?php echo e($goods->id, false); ?>" data-type="down">下架</button>
								<?php else: ?>
									<button class="btn-sm btn-orange btn-op" data-id="<?php echo e($goods->id, false); ?>" data-type="up">上架</button>
								<?php endif; ?>
							<?php endif; ?>
							<button class="btn-sm btn-orange btn-op" data-id="<?php echo e($goods->id, false); ?>" data-type="del">删除</button>
						</span>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>
	<br>
	<div>
		<?php echo e($user_goods->links(), false); ?>

	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
	<script>
		$(document).on('click', '.btn-op',function () {
		    var sure = confirm('确定执行该操作吗？');
		    if (sure) {
                var id = $(this).data('id');
                var op_type = $(this).data('type');
                $.ajax({
                    type: 'get',
                    url: '<?php echo e(route('index.usergoods.goodsOperation'), false); ?>',
                    data: {'id':id, 'op_type':op_type},
                    success: function (res) {
                        console.log(res);
                        if (res.status) {
                            alert(res.msg);
                            location.reload();
                        }
                    }
                });
			}
        });
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
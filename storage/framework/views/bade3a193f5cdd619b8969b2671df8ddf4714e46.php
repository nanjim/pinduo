

<?php $__env->startSection('style'); ?>
	##parent-placeholder-26ec8d00fb6b55466b3a115f1d559422a7fa7aac##
	<style>
		.charge-box {
			height: 15rem;
		}
		.cny-item {
			border: 1px solid #D6D4D4;
			width: 26%;
			padding: 1rem;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			text-align: center;
			margin: 1rem;
		}
		.cny-item:hover{
			cursor: pointer;
		}
		.on-sel {
			background-color: #FFF0E0;
			border: 1px solid #F97C12;
		}

		.cny {
			font-weight: 500;
			font-size: 20px;
		}
		.integral {
			color: #5F5F5F;
		}
	</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<i class="fa fa-cny fa-fw"></i> 充值中心
	<hr>
	<form action="<?php echo e(route('index.charge.postCharge'), false); ?>" method="post">
		<?php echo e(csrf_field(), false); ?>

		<div class="row d-flex justify-content-around align-content-around charge-box">
			<?php $__currentLoopData = $charge_sets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $charge_set): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="cny-item">
					<div><span class="cny"><?php echo e($charge_set->cny, false); ?></span>元</div>
					<div><span class="integral"><?php echo e($charge_set->integral, false); ?></span>积分</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
		<input type="hidden" name="cny" value="">
		<input type="hidden" name="integral" value="">
		<div>
			<button class="btn btn-orange">支付宝充值</button>
		</div>
	</form>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
	<script>
		$(document).on('click', '.cny-item', function () {
		    var cny = $(this).find('.cny').text();
		    var integral = $(this).find('.integral').text();
		    $("input[name=cny]").val(cny);
		    $("input[name=integral]").val(integral);
		    $('.cny-item').each(function () {
				if ($(this).hasClass('on-sel')) {
				    $(this).removeClass('on-sel');
				}
            });
			$(this).addClass('on-sel');
        });


	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
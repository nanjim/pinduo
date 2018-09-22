

<?php $__env->startSection('content'); ?>
<div class="myprofile-board">
	<div>
		<div class="card">
			<div class="card-header">招商放单申请</div>
			<div class="card-body">
				<form action="<?php echo e(route('index.spread'), false); ?>" method="post">
                    <?php echo e(csrf_field(), false); ?>

					<div class="form-group row">
						<div class="col-md-4 offset-3 text-center">
							<input type="radio" class="" name="type" value="1" checked <?php echo e(old('type')==1 ? 'checked' : '', false); ?>> 个人
						</div>
						<div class="col-md-4">
							<input type="radio" name="type" value="2" class="" <?php echo e(old('type')==2 ? 'checked' : '', false); ?>> 团队
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">个人/团队名称</label>
						<div class="col-md-4">
							<input type="text" name="name" class="form-control<?php echo e($errors->has('name') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('name'), false); ?>">
                            <?php if($errors->has('name')): ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('name'), false); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
					</div>
                    <div>
                    </div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">QQ</label>
						<div class="col-md-4">
							<input type="text" name="qq" class="form-control<?php echo e($errors->has('qq') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('qq'), false); ?>" >
                            <?php if($errors->has('qq')): ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('qq'), false); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
					</div>

					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">微信号</label>
						<div class="col-md-4">
							<input type="text" name="weixin" class="form-control<?php echo e($errors->has('weixin') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('weixin'), false); ?>">
                            <?php if($errors->has('weixin')): ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('weixin'), false); ?></strong>
                                </span>
                            <?php endif; ?>
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">月收入</label>
						<div class="col-md-2">
							<input type="text" name="income" class="form-control<?php echo e($errors->has('income') ? ' is-invalid' : '', false); ?>" autocomplete="off" value="<?php echo e(old('income'), false); ?>">
                            <?php if($errors->has('income')): ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('income'), false); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
						<div class="col-md-1 control-label">
							万
						</div>
					</div>
                    <div>
                    </div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">个人/团队介绍</label>
						<div class="col-md-4">
							<textarea name="desc" cols="30" rows="5" class="form-control<?php echo e($errors->has('desc') ? ' is-invalid' : '', false); ?>"><?php echo e(old('desc'), false); ?></textarea>
                            <?php if($errors->has('desc')): ?>
                                <span class="invalid-feedback">
                                    <strong><?php echo e($errors->first('desc'), false); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
					</div>
                    <div>
                    </div>
					<div class="text-center">
						<button type="submit" class="btn btn-orange">提交</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
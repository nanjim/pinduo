

<?php $__env->startSection('content'); ?>
<div class="myprofile-board ">
	<div class="col-md-8">
		<?php if(session('success')): ?>
			<div class="alert alert-success">
		    	<i class="fa fa-check"></i><?php echo e(session('success'), false); ?>

		    </div>
		<?php endif; ?>
		
		<div class="card">
			<div class="card-header">
				修改密码
			</div>
			<div class="card-body">
				<form action="<?php echo e(route('index.postModifyPassword'), false); ?>" method="post">

					<?php echo csrf_field(); ?>

				    <div class="form-group row">
				  		<label class="col-md-4 control-label">原密码：</label>
				   		<div class="col-md-5">
				   			<input type="text" class="form-control <?php echo e($errors->has('origin_password') ? 'is-invalid' : '', false); ?>" id="origin_password" autocomplete="off" name="origin_password" value="<?php echo e(old('origin_password'), false); ?>">
				   			<?php if( $errors->has('origin_password') ): ?>
					        	<span class="invalid-feedback"><?php echo e($errors->first('origin_password'), false); ?></span>
							<?php endif; ?>
				   		</div>
				    </div>

				    <div class="form-group row">
				  		<label class="col-md-4 control-label">新密码：</label>
				   		<div class="col-md-5">
				   			<input type="text" class="form-control <?php echo e($errors->has('new_password') ? 'is-invalid' : '', false); ?>" autocomplete="off" id="new_password" name="new_password">
				   			<?php if( $errors->has('new_password') ): ?>
					       		<span class="invalid-feedback"><?php echo e($errors->first('new_password'), false); ?></span>
							<?php endif; ?>
				   		</div>
				    </div>
				    
				    <div class="form-group row">
				  		<label class="col-md-4 control-label">确认密码：</label>
				  		
				   		<div class="col-md-5">
				   			<input type="text" class="form-control " autocomplete="off" id="sure_password" name="new_password_confirmation">
				   		</div>
				    </div>
					
				    <div class="offset-md-5">
				    	<button type="submit" class="btn btn-success">确认修改</button>
				    </div>

				</form>
			</div>
			
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.myprofile', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
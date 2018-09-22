<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><?php echo e(__('登录'), false); ?></div>

                <div class="card-body">
                    <form method="POST" action="<?php echo e(route('login'), false); ?>">
                        <?php echo csrf_field(); ?>

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-4 col-form-label text-md-right"><?php echo e(__('手机号'), false); ?></label>

                            <div class="col-md-6">
                                <input id="mobile" type="text" class="form-control<?php echo e($errors->has('mobile') ? ' is-invalid' : '', false); ?>" name="mobile" value="<?php echo e(old('mobile'), false); ?>" autofocus autocomplete="off">

                                <?php if($errors->has('mobile')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('mobile'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('密码'), false); ?></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : '', false); ?>" name="password" autocomplete="off">
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"><?php echo e(__('验证码'), false); ?></label>

                            <div class="col-md-3">
                                <input id="captcha" type="text" class="form-control<?php echo e($errors->has('captcha') ? ' is-invalid' : '', false); ?>" name="captcha" autocomplete="off">

                                <?php if($errors->has('captcha')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('captcha'), false); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-2">
                                <img src="<?php echo e(captcha_src(), false); ?>" title="点击切换" class="thumbnail" style="cursor: pointer;" onclick="this.src='<?php echo e(captcha_src(), false); ?>?'+Math.random()">
                            </div>
                        </div>

                        
                            
                                
                                    
                                        
                                    
                                
                            
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    <?php echo e(__('登录'), false); ?>

                                </button>

                                <a class="btn btn-link" href="<?php echo e(url('password/getReset'), false); ?>">
                                    <?php echo e(__('忘记密码?'), false); ?>

                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
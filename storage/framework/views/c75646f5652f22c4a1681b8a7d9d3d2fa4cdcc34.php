<div class="<?php echo e($viewClass['form-group'], false); ?> <?php echo !$errors->has($errorKey) ? '' : 'has-error'; ?>">

    <label for="<?php echo e($id, false); ?>" class="<?php echo e($viewClass['label'], false); ?> control-label"><?php echo e($label, false); ?></label>

    <div class="<?php echo e($viewClass['field'], false); ?>">

        <?php echo $__env->make('admin::form.error', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(!$inline): ?><div class="radio"><?php endif; ?>
                <label <?php if($inline): ?>class="radio-inline"<?php endif; ?>>
                    <input type="radio" name="<?php echo e($name, false); ?>" value="<?php echo e($option, false); ?>" class="minimal <?php echo e($class, false); ?>" <?php echo e(($option == old($column, $value))?'checked':'', false); ?> />&nbsp;<?php echo e($label, false); ?>&nbsp;&nbsp;
                </label>
            <?php if(!$inline): ?></div><?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php echo $__env->make('admin::form.help-block', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </div>
</div>

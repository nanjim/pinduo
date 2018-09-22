<?php error_reporting(E_ERROR|E_CORE_WARNING);?>
<div class="sort">
	<ul>
		<?php $__currentLoopData = $sort; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			

			<a  href="<?php echo e($query['sort_type'] == $item['asc'] ? route('entry', array_merge($query, ['sort_type'=>$item['desc']])) : route('entry', array_merge($query, ['sort_type'=>$item['asc']])), false); ?>">
			
			
			
				<li>
					<?php echo e($item['title'], false); ?>

					<div class="icon">
						<i class="fa fa-caret-up <?php echo e(isset($query['sort_type']) && $query['sort_type'] == $item['asc'] ? 'sort-type-sel' : '', false); ?>"></i>
						<i class="fa fa-caret-down <?php echo e(isset($query['sort_type']) && $query['sort_type'] == $item['desc'] ? 'sort-type-sel' : '', false); ?>"></i>
					</div>
				</li>
			</a>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>
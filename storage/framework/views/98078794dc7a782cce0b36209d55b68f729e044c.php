<?php error_reporting(E_ERROR|E_CORE_WARNING);?>
<div class="option index">
	<div class="catgory option-item">
		<span class="title">分类：</span>
		<?php $__currentLoopData = $cat_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<a href="<?php echo e(route('entry', ['cat_id'=>$cat->cat_id]), false); ?>" class="cat-item <?php echo e($query['cat_id'] == $cat->cat_id ? 'cat-item-sel' : '', false); ?>"><?php echo e($cat->name, false); ?></a>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	<div class="select option-item">
		<form action="<?php echo e(route('entry'), false); ?>">
			<span class="title">筛选：</span>
			<span class="select-item">
                价格 <input class="option-input" type="text" name="range_list[range_from]" value="<?php echo e($query['range_list']['range_from'], false); ?>"> ~ <input class="option-input" type="text" name="range_list[range_to]" value="<?php echo e($query['range_list']['range_to'], false); ?>">
            </span>
			<span class="select-item">
                销量 > <input class="option-input" type="text" name="range_list[sale_num]" id="" value="<?php echo e($query['range_list']['sale_num'], false); ?>"> 笔
            </span>
			<span class="select-item">
                佣金比例 > <input class="option-input" type="text" name="range_list[rate]" id="" value="<?php echo e($query['range_list']['rate'], false); ?>">%
            </span>
			<span class="select-item">
                <button class="btn-sm  btn-warning">确定</button>
            </span>
		</form>
	</div>
</div>

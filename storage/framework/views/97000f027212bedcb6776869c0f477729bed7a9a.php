<?php $__env->startSection('content'); ?>

<div class="adv">

</div>


<div class="option index">
    <div class="catgory option-item">
        <span class="title">分类：</span>

        <?php $__currentLoopData = $cat_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('index',['cat_id'=>$cat->cat_id]), false); ?>" class="cat-item <?php echo e(isset($view_data['cat_id']) && $view_data['cat_id'] == $cat->cat_id ? 'cat-item-sel' : '', false); ?>"><?php echo e($cat->name, false); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <div class="select option-item">
        <form action="<?php echo e(route('index'), false); ?>">
            <span class="title">筛选：</span>
            <span class="select-item">
                价格 <input class="option-input" type="text" name="price_from" value="<?php echo e(isset($paginator->query['price_from']) ? $paginator->query['price_from'] : '', false); ?>"> ~ <input class="option-input" type="text" name="price_to" value="<?php echo e(isset($paginator->query['price_to']) ? $paginator->query['price_to'] : '', false); ?>">
            </span>
                <span class="select-item">
                销量 > <input class="option-input" type="text" name="base_sale" id="" value="<?php echo e(isset($paginator->query['base_sale']) ? $paginator->query['base_sale'] : '', false); ?>"> 笔
            </span>
                <span class="select-item">
                佣金比例 > <input class="option-input" type="text" name="base_rate" id="" value="<?php echo e(isset($paginator->query['base_rate']) ? $paginator->query['base_rate'] : '', false); ?>">%
            </span>
                <span class="select-item">
                <button class="btn-sm  btn-warning">确定</button>
            </span>
        </form>
    </div>
</div>

<div class="sort">
    <ul>
        <a href="<?php echo e(route('index',array_merge($paginator->query,['sort_type'=>0])), false); ?>">
            <li>
                综合排序
            </li>
        </a>
        <a href="<?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 6 ? route('index',array_merge($paginator->query,['sort_type'=>5])) : route('index',array_merge($paginator->query,['sort_type'=>6])), false); ?>">
            <li>
                销量
                <div class="icon">
                    <i class="fa fa-caret-up <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 5 ? 'sort-type-sel' : '', false); ?>"></i>
                    <i class="fa fa-caret-down <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 6 ? 'sort-type-sel' : '', false); ?>"></i>
                </div>
            </li>
        </a>
        <a  href="<?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 9 ? route('index',array_merge($paginator->query,['sort_type'=>10])) : route('index',array_merge($paginator->query,['sort_type'=>9])), false); ?>">
            <li>
                券后价
                <div class="icon">
                    <i class="fa fa-caret-up <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 9 ? 'sort-type-sel' : '', false); ?>"></i>
                    <i class="fa fa-caret-down <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 10 ? 'sort-type-sel' : '', false); ?>"></i>
                </div>
            </li>
        </a>
        
            
                
                
                    
                    
                
            
        
        <a  href="<?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 2 ? route('index',array_merge($paginator->query,['sort_type'=>1])) : route('index',array_merge($paginator->query,['sort_type'=>2])), false); ?>">
            <li>
                佣金比率
                <div class="icon">
                    <i class="fa fa-caret-up <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 1 ? 'sort-type-sel' : '', false); ?>"></i>
                    <i class="fa fa-caret-down <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 2 ? 'sort-type-sel' : '', false); ?>"></i>
                </div>
            </li>
        </a>
        <a  href="<?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 8 ? route('index',array_merge($paginator->query,['sort_type'=>7])) : route('index',array_merge($paginator->query,['sort_type'=>8])), false); ?>">
            <li>
                优惠券
                <div class="icon">
                    <i class="fa fa-caret-up <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 7 ? 'sort-type-sel' : '', false); ?>"></i>
                    <i class="fa fa-caret-down <?php echo e(isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 8 ? 'sort-type-sel' : '', false); ?>"></i>
                </div>
            </li>
        </a>
    </ul>
</div>

<div class="goods-container">
    <div id="goods-list" class="goods-list d-flex flex-wrap justify-content-around">
        <?php echo $__env->make('index.index.goods_list',['data'=>$data], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </div><br>
    <div class="page text-center col-md-12">
        <?php echo e($paginator->links(), false); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    ##parent-placeholder-93f8bb0eb2c659b85694486c41717eaf0fe23cd4##
    <script>
        // $('body').on('hover','.goods',function(){
        //     alert(13);
        // },function(){

        // });
        // $(function(){
        //     $(".goods").hover(function(){
        //         var desc = $(this).find('.goods-desc');
        //         desc.show();
        //         $(this).addClass('rounded-top');
        //         $(this).css('border-radius','0');
        //         var id = $(this).data('id');
        //         $.ajax({
        //             type:"post",
        //             url:"/goods/postDetail",
        //             data:{"id":id,"_token":"<?php echo e(csrf_token(), false); ?>"},
        //             success:function(data){
        //                 var data = JSON.parse(data);
        //                 var desc_content = data.goods_detail_response.goods_details[0].goods_desc;
        //                 desc.html(desc_content);
        //             },
        //             error:function(data){
        //                 console.log(123456);
        //             }
        //         });
        //     },function(){
        //         $(this).find('.goods-desc').hide();
        //         $(this).removeClass('rounded-top');
        //         $(this).css('border-radius','.25rem');
        //     });
        // })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('index.layout.index', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="user-center">
    <div class="left-menu">
        <ul class="">
            <li>
                <a class="<?php echo e($item=='baseData' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.baseData'), false); ?>">
                    <i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料
                </a>
            </li>
            <li>
                <a class="<?php echo e($item=='myNotice' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.myNotice'), false); ?>">
                    <i class="fa fa-camera-retro fa-fw"></i>&nbsp; 我的消息
                    <?php if(session('msg_count') > 0): ?>
                        <span class="badge badge-pill badge-danger"><?php echo e(session('msg_count'), false); ?></span>
                    <?php endif; ?>
                </a>
            </li>
            <li>
                <a class="<?php echo e($item=='modifyPassword' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.modifyPassword'), false); ?>">   <i class="fa fa-cog fa-fw"></i>&nbsp; 修改密码
                </a>
            </li>
            <li>
                <a class="<?php echo e($item=='spread' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.spread'), false); ?>">
                    <i class="fa fa-send fa-fw"></i>&nbsp; 发布推广
                </a>
            </li>
            <li>
                <a class="<?php echo e($item=='merchandiseManage' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.merchandiseManage'), false); ?>">
                    <i class="fa fa-shopping-bag fa-fw"></i>&nbsp; 商品管理
                </a>
            </li>
            <li>
                <a class="<?php echo e($item=='myCollection' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.myStar'), false); ?>">
                    <i class="fa fa-camera-retro fa-fw"></i>&nbsp; 我的收藏
                </a>
            </li>
            <li>
                <a class="<?php echo e($item=='mySite' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.mySite'), false); ?>">
                    <i class="fa fa-camera-retro fa-fw"></i>&nbsp; 我的网站
                </a>
            </li>
            <li>
                <a class="<?php echo e($item=='charge' ? 'menu-now' : '', false); ?>" href="<?php echo e(route('index.myprofile.charge'), false); ?>">
                    <i class="fa fa-cny fa-fw"></i>&nbsp; 充值中心
                </a>
            </li>
        </ul>
    </div>
</div>
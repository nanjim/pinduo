<?php error_reporting(E_ERROR);?>
<div class="container-fluid header-top">
    <div class="row">

        <div class="col-md-2 logo-box">
            <a class="navbar-brand" href="<?php echo e(url('/'), false); ?>">
               <img id="logo" src="/img/site/huimaike.png?v=1" alt=""><br>
            </a>
        </div>

        <div class="col-md-5 offset-md-1">
            <div class="search-box">
                <form action="<?php echo e(route('entry'), false); ?>" >
                    <input id="keyword" type="text" name="title" placeholder="请输入关键词" value="<?php echo e(isset($query['title']) ? $query['title'] : '', false); ?>">
                    <input id="search-btn" class="text-right" type="submit" value="搜索">
                </form>
            </div>
            <div class="hot-search">
                热门搜索：
                <a href="<?php echo e(route('entry',['title'=>'芒果']), false); ?>">芒果</a>
                <a href="<?php echo e(route('entry',['title'=>'连衣裙']), false); ?>">连衣裙</a>
                <a href="<?php echo e(route('entry',['title'=>'两件套']), false); ?>">两件套</a>
                <a href="<?php echo e(route('entry',['title'=>'女鞋']), false); ?>">女鞋</a>
                <a href="<?php echo e(route('entry',['title'=>'凉鞋']), false); ?>">凉鞋</a>
                <a href="<?php echo e(route('entry',['title'=>'T恤']), false); ?>">T恤</a>
                <a href="<?php echo e(route('entry',['title'=>'男鞋']), false); ?>">男鞋</a>
            </div>
        </div>

        <div class="col-md-3 ">
            <ul class="nav-list">
                <?php if(auth()->guard()->guest()): ?>
                    <a class="" href="<?php echo e(route('register'), false); ?>">
                        <li class="nav-item col-md-4">
                            <?php echo e(__('注册'), false); ?>

                        </li>
                    </a>
                    <a class="" href="<?php echo e(route('login'), false); ?>">
                        <li class="nav-item col-md-4">
                            <?php echo e(__('登录'), false); ?>

                        </li>
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('index.myprofile.baseData'), false); ?>"><img id="header-avatar" src="<?php echo e(URL::asset(Auth::user()->avatar ? 'upload/'.Auth::user()->avatar : 'img/avatar1.png'), false); ?>" alt=""></a>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <?php echo e(Auth::user()->mobile, false); ?> <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="<?php echo e(route('index.myprofile.baseData'), false); ?>">
                                <?php echo e(__('个人中心'), false); ?>

                            </a>

                            <a class="dropdown-item" href="<?php echo e(route('logout'), false); ?>" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                <?php echo e(__('退出'), false); ?>

                            </a>

                            <form id="logout-form" action="<?php echo e(route('logout'), false); ?>" method="POST" style="display: none;">
                                <?php echo csrf_field(); ?><br>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>
<div class="header-title-nav">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <?php $__currentLoopData = config('common.nav'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="nav-title-item">
                <a href="<?php echo e(route('entry', ['index'=>$item['index']]), false); ?>" class="nav-click <?php echo e($item['index']==$index ? 'nav-on' : '', false); ?>"><h5><?php echo e($item['name'], false); ?></h5></a>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </nav>
</div>
            

<div class="container-fluid header-top">
    <div class="row">

        <div class="col-md-2 logo-box">
            <a class="navbar-brand" href="<?php echo e(url('/'), false); ?>">
               <img id="logo" src="/img/site/huimaike.png?v=1" alt=""><br>
            </a>
        </div>

        <div class="col-md-5 offset-md-1">
            <div class="search-box">
                <form action="<?php echo e(route('index'), false); ?>" >
                    <input id="keyword" type="text" name="keyword" placeholder="请输入关键词" value="<?php echo e(isset($keyword) ? $keyword : '', false); ?>">
                    <input id="search-btn" class="text-right" type="submit" value="搜索">
                </form>
            </div>
            <div class="hot-search">
                热门搜索：
                <a href="<?php echo e(route('index',['keyword'=>'芒果']), false); ?>">芒果</a>
                <a href="<?php echo e(route('index',['keyword'=>'连衣裙']), false); ?>">连衣裙</a>
                <a href="<?php echo e(route('index',['keyword'=>'两件套']), false); ?>">两件套</a>
                <a href="<?php echo e(route('index',['keyword'=>'女鞋']), false); ?>">女鞋</a>
                <a href="<?php echo e(route('index',['keyword'=>'凉鞋']), false); ?>">凉鞋</a>
                <a href="<?php echo e(route('index',['keyword'=>'T恤']), false); ?>">T恤</a>
                <a href="<?php echo e(route('index',['keyword'=>'男鞋']), false); ?>">男鞋</a>
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
                    <a href="<?php echo e(url('/myprofile/baseData'), false); ?>"><img id="header-avatar" src="<?php echo e(URL::asset(Auth::user()->avatar), false); ?>" alt=""></a>
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
        <div class="nav-title-item">
            <a href="<?php echo e(url('/'), false); ?>" class="nav-click <?php echo e(isset($nav) && $nav=='index' ? 'nav-on' : '', false); ?>"><h5>实时爆款</h5></a>
        </div>
        <div class="nav-title-item">
            <a href="<?php echo e(url('/top'), false); ?>" class="nav-click <?php echo e(isset($nav) && $nav=='top' ? 'nav-on' : '', false); ?>"><h5>今日榜单</h5></a>
        </div>
        <div class="nav-title-item">
            <a href="<?php echo e(url('/mysite'), false); ?>" class="nav-click <?php echo e(isset($nav) && $nav=='mysite' ? 'nav-on' : '', false); ?>"><h5>我的网站</h5></a>
        </div>
    </nav>
</div>
            

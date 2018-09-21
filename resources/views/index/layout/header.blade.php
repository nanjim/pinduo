<div class="container-fluid header-top">
    <div class="row">

        <div class="col-md-2 logo-box">
            <a class="navbar-brand" href="{{ url('/') }}">
               <img id="logo" src="/img/site/huimaike.png?v=1" alt=""><br>
            </a>
        </div>

        <div class="col-md-5 offset-md-1">
            <div class="search-box">
                <form action="{{route('index')}}" >
                    <input id="keyword" type="text" name="keyword" placeholder="请输入关键词" value="{{isset($keyword) ? $keyword : ''}}">
                    <input id="search-btn" class="text-right" type="submit" value="搜索">
                </form>
            </div>
            <div class="hot-search">
                热门搜索：
                <a href="{{route('index',['keyword'=>'芒果'])}}">芒果</a>
                <a href="{{route('index',['keyword'=>'连衣裙'])}}">连衣裙</a>
                <a href="{{route('index',['keyword'=>'两件套'])}}">两件套</a>
                <a href="{{route('index',['keyword'=>'女鞋'])}}">女鞋</a>
                <a href="{{route('index',['keyword'=>'凉鞋'])}}">凉鞋</a>
                <a href="{{route('index',['keyword'=>'T恤'])}}">T恤</a>
                <a href="{{route('index',['keyword'=>'男鞋'])}}">男鞋</a>
            </div>
        </div>

        <div class="col-md-3 ">
            <ul class="nav-list">
                @guest
                    <a class="" href="{{ route('register') }}">
                        <li class="nav-item col-md-4">
                            {{ __('注册') }}
                        </li>
                    </a>
                    <a class="" href="{{ route('login') }}">
                        <li class="nav-item col-md-4">
                            {{ __('登录') }}
                        </li>
                    </a>
                @else
                    <a href="{{url('/myprofile/baseData')}}"><img id="header-avatar" src="{{URL::asset(Auth::user()->avatar)}}" alt=""></a>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->mobile }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('index.myprofile.baseData') }}">
                                {{ __('个人中心') }}
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
                                {{ __('退出') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf<br>
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</div>
<div class="header-title-nav">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="nav-title-item">
            <a href="{{url('/')}}" class="nav-click {{isset($nav) && $nav=='index' ? 'nav-on' : ''}}"><h5>实时爆款</h5></a>
        </div>
        <div class="nav-title-item">
            <a href="{{url('/top')}}" class="nav-click {{isset($nav) && $nav=='top' ? 'nav-on' : ''}}"><h5>今日榜单</h5></a>
        </div>
        <div class="nav-title-item">
            <a href="{{url('/mysite')}}" class="nav-click {{isset($nav) && $nav=='mysite' ? 'nav-on' : ''}}"><h5>我的网站</h5></a>
        </div>
    </nav>
</div>
            

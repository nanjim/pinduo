<?php error_reporting(E_ERROR);?>
<div class="container-fluid header-top">
    <div class="row">

        <div class="col-md-2 logo-box">
            <a class="navbar-brand" href="{{ url('/') }}">
               <img id="logo" src="/img/site/huimaike.png?v=1" alt=""><br>
            </a>
        </div>

        <div class="col-md-5 offset-md-1">
            <div class="search-box">
                <form action="{{route('entry')}}" >
                    <input id="keyword" type="text" name="title" placeholder="请输入关键词" value="{{isset($query['title']) ? $query['title'] : ''}}">
                    <input id="search-btn" class="text-right" type="submit" value="搜索">
                </form>
            </div>
            <div class="hot-search">
                热门搜索：
                <a href="{{route('entry',['title'=>'芒果'])}}">芒果</a>
                <a href="{{route('entry',['title'=>'连衣裙'])}}">连衣裙</a>
                <a href="{{route('entry',['title'=>'两件套'])}}">两件套</a>
                <a href="{{route('entry',['title'=>'女鞋'])}}">女鞋</a>
                <a href="{{route('entry',['title'=>'凉鞋'])}}">凉鞋</a>
                <a href="{{route('entry',['title'=>'T恤'])}}">T恤</a>
                <a href="{{route('entry',['title'=>'男鞋'])}}">男鞋</a>
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
                    <a href="{{route('index.myprofile.baseData')}}"><img id="header-avatar" src="{{URL::asset('upload/'.Auth::user()->avatar)}}" alt=""></a>
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
        @foreach(config('common.nav') as $item)
            <div class="nav-title-item">
                <a href="{{route('entry', ['index'=>$item['index']])}}" class="nav-click {{$item['index']==$index ? 'nav-on' : ''}}"><h5>{{$item['name']}}</h5></a>
            </div>
        @endforeach
    </nav>
</div>
            

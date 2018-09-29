<?php error_reporting(E_ERROR);?>

<style>
    .top-line {
        height: 2rem;
        background: #F2F2F2;
        padding: 0 8%;
        border-bottom: 1px solid #EEEEEE;
    }
    .top-line .login-item {
        color: #FF6C0C;
        line-height: 2rem;
    }
    .top-line .sep {
        margin: 0 1rem;
        color: #FF6C0C;
        line-height: 2rem;
    }
    .col-md-4 {
        padding: 0;
    }
</style>
@include('index.layout.top')
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

        <div class="col-md-4 pull-right">
            <ul class="nav-list">
                @guest

                @else
                    <a class="pull-right" href="{{route('index.myprofile.baseData')}}"><img id="header-avatar" src="{{URL::asset(Auth::user()->avatar ? 'upload/'.Auth::user()->avatar : 'img/avatar1.png')}}" alt=""></a>
                    <span class="pull-right" style="line-height: 3rem;margin-right: 1rem">
                        {{ Auth::user()->mobile }} <span class="caret"></span>
                    </span>
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
            

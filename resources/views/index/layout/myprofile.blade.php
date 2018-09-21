<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '惠麦客') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    @section('style')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/foot.css')}}">
        <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet">
    @show
</head>
<style>
    input {outline: none}
    #keyword{width:80%;outline: none;background: white;font-size: 15px;border: none;height: 36px;margin-top: 2px;margin-left: 10px;color: #A6A5A5}
    #search-btn {background: #F47808;color: white;height: 40px;margin-left: -5px;border: none;position: absolute;right: 0;padding: 0 20px;}
    #search-btn:hover {cursor:pointer;}
    .search-box {border: 2px solid #F47808;position: relative;height: 44px;}
    #logo {width: 50px;height: 50px;}
    .navbar-brand {padding: 0;text-align: center;}
    .dropdown-toggle:after {display: none;}
    .header-top {padding: 30px 50px;background: white}
    .logo-box {text-align: center;}
    .nav-title-item a{color: #9A9998;display: block;text-align: center;height: 50px;}
    .nav-title-item h5 {line-height: 50px;}
    .nav-title-item a:hover {background: #FF7500;border: none;color: white}
    .nav-title-item {padding: 0;width:13%;}
    a,a:hover {
        text-decoration: none;
    }
    .header-title-nav .navbar {
        padding: 0;
    }
    .header-title-nav {
        padding: 0 50px;
        background: white;
    }
    .nav-on {
        background: #FF7500;
        color: white !important;
    }
    .hot-search,.hot-search a {
        color: #BDBDBD
    }
    .nav-list li{
        float: right;
        list-style: none;
    }
    .nav-item {
        padding: 10px;
    }
    .main-board {
        padding: 30px 5px;
    }
    .left-menu li {
        list-style: none;
    }
    .left-menu a {
        width: 100%;
        display: block;
        background: white;
        padding: 10px 30px;
        color: #979696
    }
    .left-menu a:hover,a.menu-now {
        color: white;
        background: #EF7A48;
    }
    .myprofile-board {
        background: white;
        min-height: 400px;
        padding: 50px 50px;
    }
    .control-label {
        line-height: 40px;
        text-align: right;
        color: #8E8E8E
    }
    .btn-orange {
        background: #F87A08;
        color:white;
    }
    .myprofile-board .alert {
        padding:5px 10px;
    }
    #main-img {
        width: 100%;
        height: 100%;
    }
    .btn-mysite {
        height: 2.5rem;
    }
</style>
<body>
    <div id="app">
        @include('index.layout.entry_header')
        <div class="row main-board">
            <div class="col-md-2">
                @include('index.layout.left_menu')
            </div>
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
        
        @include('index.layout.foot')
    </div>
</body>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.0.2/layer.min.js"></script>
@section('js')

@show
</html>

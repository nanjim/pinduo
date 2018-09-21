<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <title>{{session('title')}}</title>

    <!-- Styles -->
    <link href="https://cdn.bootcss.com/Swiper/4.3.0/css/swiper.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/mobile/mobile.css')}}">
    <link rel="stylesheet" href="{{asset('css/mobile/goodsList.css')}}">
    <link rel="stylesheet" href="{{asset('js/plugins/mescroll/dist/mescroll.min.css')}}">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    @section('style')
    @show
</head>

<body>
    <div id="wrap" class="col-md-4 col-md-offset-4 ">
        <div id="list" class="mescroll">
            @include('mobile.layout.top')
            @yield('content')
        </div>
    </div>
</body>
<!-- Scripts -->
<script src="https://cdn.bootcss.com/vue/2.2.2/vue.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>
<script src="{{asset('js/scrollToTop.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/mescroll/dist/mescroll.min.js')}}"></script>
@section('js')

@show
</html>



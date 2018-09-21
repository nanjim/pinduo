<?php error_reporting(E_ERROR|E_CORE_WARNING);?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', '惠麦客') }}</title>

    <!-- Styles -->
    @section('style')
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
        <link rel="stylesheet" href="{{URL::asset('css/foot.css')}}">
        <link href="{{URL::asset('css/font-awesome.min.css')}}" rel="stylesheet">
    @show
</head>
<body>
        
    <div id="wrap">
        @include('index.layout.entry_header')
        @yield('content')
        @include('index.layout.foot')
    </div>
    <i id="toTop" class="fa fa-arrow-circle-up toTop"></i>
    <i v-on:click="star()" id="star-box" class="fa fa-star-o star-box"></i>
</body>
<!-- Scripts -->
<script src="https://cdn.bootcss.com/vue/2.2.2/vue.min.js"></script>
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/layer/3.1.0/layer.js"></script>

<script src="{{ asset('js/main.js') }}"></script>
<script src="{{asset('js/scrollToTop.js')}}"></script>
<script>

    var topElement = document.getElementById("toTop");

    var toTop = new ScrollToTop(topElement, {
        showWhen: 1500,
        speed: 500
    })

    var goods = new Vue({
        el: '#goods-list',
        methods: {
            star: function(event){
                var id = event.target.dataset.id;
                var url = "/user/star/"+id;
                $.ajax({
                    type:"get",
                    url:url,
                    success:function(res){
                        $data = JSON.parse(res);
                        if($data['status']){
                            if($data['is_exist']){
                                layer.alert('已收藏',{icon:5});
                            }else{
                                layer.alert('收藏成功',{icon:1});
                            }
                        }else{
                            location.href = "{{url('/login')}}";
                        }
                    }
                });
            }
        }
    })
    
</script>
@section('js')

@show
</html>



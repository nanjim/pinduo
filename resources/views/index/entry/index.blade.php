
@extends('index.layout.entry')

@section('content')
@include('index.goods.cat')
@include('index.goods.sort')
{{--商品--}}
<div class="goods-container">
    <div id="goods-list" class="goods-list d-flex flex-wrap justify-content-around">
        @include('index.goods.goodsList',['data'=>$goodsList])
    </div><br>
    <div class="page text-center col-md-12">
        {{$goodsList->render()}}
    </div>
</div>
{{--商品--}}
@endsection
<?php error_reporting(E_ERROR);?>
{{--@section('js)--}}

{{--@endsection--}}
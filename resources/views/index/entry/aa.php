<?php

{{--广告--}}
<div class="adv">

</div>
{{--广告--}}
{{--分类--}}
<div class="option index">
    <div class="catgory option-item">
        <span class="title">分类：</span>
        @foreach($cat_list as $cat)
            <a href="{{route('index',['cat_id'=>$cat->cat_id])}}" class="cat-item {{isset($view_data['cat_id']) && $view_data['cat_id'] == $cat->cat_id ? 'cat-item-sel' : ''}}">{{$cat->name}}</a>
        @endforeach
    </div>
    <div class="select option-item">
        <form action="{{route('index')}}">
            <span class="title">筛选：</span>
            <span class="select-item">
                价格 <input class="option-input" type="text" name="price_from" value="{{isset($paginator->query['price_from']) ? $paginator->query['price_from'] : ''}}"> ~ <input class="option-input" type="text" name="price_to" value="{{isset($paginator->query['price_to']) ? $paginator->query['price_to'] : ''}}">
            </span>
                <span class="select-item">
                销量 > <input class="option-input" type="text" name="base_sale" id="" value="{{isset($paginator->query['base_sale']) ? $paginator->query['base_sale'] : ''}}"> 笔
            </span>
                <span class="select-item">
                佣金比例 > <input class="option-input" type="text" name="base_rate" id="" value="{{isset($paginator->query['base_rate']) ? $paginator->query['base_rate'] : ''}}">%
            </span>
                <span class="select-item">
                <button class="btn-sm  btn-warning">确定</button>
            </span>
        </form>
    </div>
</div>
{{--分类--}}
<div class="sort">
    <ul>
        <a href="{{route('index',array_merge($paginator->query,['sort_type'=>0]))}}">
            <li>
                综合排序
            </li>
        </a>
        <a href="{{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 6 ? route('index',array_merge($paginator->query,['sort_type'=>5])) : route('index',array_merge($paginator->query,['sort_type'=>6]))}}">
            <li>
                销量
                <div class="icon">
                    <i class="fa fa-caret-up {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 5 ? 'sort-type-sel' : ''}}"></i>
                    <i class="fa fa-caret-down {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 6 ? 'sort-type-sel' : ''}}"></i>
                </div>
            </li>
        </a>
        <a  href="{{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 9 ? route('index',array_merge($paginator->query,['sort_type'=>10])) : route('index',array_merge($paginator->query,['sort_type'=>9]))}}">
            <li>
                券后价
                <div class="icon">
                    <i class="fa fa-caret-up {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 9 ? 'sort-type-sel' : ''}}"></i>
                    <i class="fa fa-caret-down {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 10 ? 'sort-type-sel' : ''}}"></i>
                </div>
            </li>
        </a>
        {{--<a  href="{{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 0 ? route('index',array_merge($paginator->query,['sort_type'=>1])) : route('index',array_merge($paginator->query,['sort_type'=>0]))}}">--}}
            {{--<li>--}}
                {{--跑单量--}}
                {{--<div class="icon">--}}
                    {{--<i class="fa fa-caret-up {{isset($view_data['sort_type']) && $view_data['sort_type'] == 0 ? 'sort-type-sel' : ''}}"></i>--}}
                    {{--<i class="fa fa-caret-down {{isset($view_data['sort_type']) && $view_data['sort_type'] == 0 ? 'sort-type-sel' : ''}}"></i>--}}
                {{--</div>--}}
            {{--</li>--}}
        {{--</a>--}}
        <a  href="{{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 2 ? route('index',array_merge($paginator->query,['sort_type'=>1])) : route('index',array_merge($paginator->query,['sort_type'=>2]))}}">
            <li>
                佣金比率
                <div class="icon">
                    <i class="fa fa-caret-up {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 1 ? 'sort-type-sel' : ''}}"></i>
                    <i class="fa fa-caret-down {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 2 ? 'sort-type-sel' : ''}}"></i>
                </div>
            </li>
        </a>
        <a  href="{{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 8 ? route('index',array_merge($paginator->query,['sort_type'=>7])) : route('index',array_merge($paginator->query,['sort_type'=>8]))}}">
            <li>
                优惠券
                <div class="icon">
                    <i class="fa fa-caret-up {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 7 ? 'sort-type-sel' : ''}}"></i>
                    <i class="fa fa-caret-down {{isset($paginator->query['sort_type']) && $paginator->query['sort_type'] == 8 ? 'sort-type-sel' : ''}}"></i>
                </div>
            </li>
        </a>
    </ul>
</div>
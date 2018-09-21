<?php error_reporting(E_ERROR|E_CORE_WARNING);?>
<div class="option index">
	<div class="catgory option-item">
		<span class="title">分类：</span>
		@foreach($cat_list as $cat)
			<a href="{{route('entry', ['cat_id'=>$cat->cat_id])}}" class="cat-item {{$query['cat_id'] == $cat->cat_id ? 'cat-item-sel' : ''}}">{{$cat->name}}</a>
		@endforeach
	</div>
	<div class="select option-item">
		<form action="{{route('entry')}}">
			<span class="title">筛选：</span>
			<span class="select-item">
                价格 <input class="option-input" type="text" name="range_list[range_from]" value="{{$query['range_list']['range_from']}}"> ~ <input class="option-input" type="text" name="range_list[range_to]" value="{{$query['range_list']['range_to']}}">
            </span>
			<span class="select-item">
                销量 > <input class="option-input" type="text" name="range_list[sale_num]" id="" value="{{$query['range_list']['sale_num']}}"> 笔
            </span>
			<span class="select-item">
                佣金比例 > <input class="option-input" type="text" name="range_list[rate]" id="" value="{{$query['range_list']['rate']}}">%
            </span>
			<span class="select-item">
                <button class="btn-sm  btn-warning">确定</button>
            </span>
		</form>
	</div>
</div>

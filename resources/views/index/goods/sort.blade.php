<?php error_reporting(E_ERROR|E_CORE_WARNING);?>
<div class="sort">
	<ul>
		@foreach($sort as $item)
			{{--@if(isset($query['sort_type']))--}}
{{--			<a  href="{{$query['sort_type'] == $item['asc'] ? url()->full().'&sort_type='.$item['desc'] : url()->full().'&sort_type='.$item['asc']}}">--}}
			<a  href="{{$query['sort_type'] == $item['asc'] ? route('entry', array_merge($query, ['sort_type'=>$item['desc']])) : route('entry', array_merge($query, ['sort_type'=>$item['asc']]))}}">
			{{--@else--}}
			{{--<a  href="{{url()->full().'?sort_type='.$item['asc']}}">--}}
			{{--@endif--}}
				<li>
					{{$item['title']}}
					<div class="icon">
						<i class="fa fa-caret-up {{isset($query['sort_type']) && $query['sort_type'] == $item['asc'] ? 'sort-type-sel' : ''}}"></i>
						<i class="fa fa-caret-down {{isset($query['sort_type']) && $query['sort_type'] == $item['desc'] ? 'sort-type-sel' : ''}}"></i>
					</div>
				</li>
			</a>
		@endforeach
	</ul>
</div>
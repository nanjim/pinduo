<div class="search-wrap col-md-4 col-xs-12">
    <div class="logo">
        <a href="{{route('mobile.index.index', ['user_id'=>session('user_id')])}}"><img src="/img/site/huimaike.png" alt=""></a>
    </div>
    <div class="search-input-box">
        <form id="search-form" action="{{route('mobile.index.search')}}">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="搜索关键字或标题" name="q" value="{{isset($querys['q']) ? $querys['q'] : ''}}">
        </form>
    </div>
</div>
<div class="sort col-md-4 col-xs-12">

    <a href="{{route('mobile.index.search', array_merge($querys, ['sort'=>0]))}}"><div class="sort-item sum "><span class={{!isset($querys['sort']) || $querys['sort']==0 ? 'def' : ''}}>综合</span></div></a>

    <a href="{{route('mobile.index.search', array_merge($querys, ['sort'=>8]))}}"><div class="sort-item disc"><span class={{isset($querys['sort']) && $querys['sort']==8 ? 'def' : ''}}>实惠</span></div></a>

    <a href="{{route('mobile.index.search', array_merge($querys, ['sort'=>6]))}}"><div class="sort-item sale"><span class={{isset($querys['sort']) && $querys['sort']==6 ? 'def' : ''}}>销量</span></div></a>

    @if(isset($querys['sort']) && ($querys['sort']==3 || $querys['sort']==4))
        <a href="{{route('mobile.index.search', array_merge($querys, ['sort'=>12/$querys['sort']]))}}"><div class="sort-item price"><span class="def">价格</span></div></a>
    @else
        <a href="{{route('mobile.index.search', array_merge($querys, ['sort'=>3]))}}"><div class="sort-item price"><span>价格</span></div></a>
    @endif

</div>
@section('js')

@endsection
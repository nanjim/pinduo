<div class="search-wrap col-md-4 col-xs-12">
    <div class="logo">
        <img src="{{URL::asset('img/site/huimaike.png')}}" alt="">
    </div>
    <div class="search-input-box">
        <form id="search-form" action="{{route('mobile.index.search')}}">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="搜索关键字或标题" name="q">
        </form>
    </div>
</div>
<div class="cats col-md-4 col-xs-12">
    @foreach($cats as $cat)
        @if(isset($querys['cat_id']) && $querys['cat_id']==$cat->id)
            <a href="{{route('mobile.index.index', ['cat_id'=>$cat->id])}}"><div class="cat-item"><span class="def">{{$cat->name}}</span></div></a>
        @else
            <a href="{{route('mobile.index.index', ['cat_id'=>$cat->id])}}"><div class="cat-item"><span>{{$cat->name}}</span></div></a>
        @endif
    @endforeach
</div> 
<div class="flash swiper-container">
    <div class="swiper-wrapper">
        @foreach($flashs as $flash)
            <div class="swiper-slide"><a href="{{$flash->link}}"><img src="{{URL::asset($flash->img_url)}}" class="banner" alt="" /></a></div>
        @endforeach
    </div>
    <div class="swiper-pagination"></div>
</div>
<div class="sort">

    <a href="{{route('mobile.index.index', array_merge($querys, ['sort'=>0]))}}"><div class="sort-item sum "><span class={{!isset($querys['sort']) || $querys['sort']==0 ? 'def' : ''}}>综合</span></div></a>

    <a href="{{route('mobile.index.index', array_merge($querys, ['sort'=>8]))}}"><div class="sort-item disc"><span class={{isset($querys['sort']) && $querys['sort']==8 ? 'def' : ''}}>实惠</span></div></a>

    <a href="{{route('mobile.index.index', array_merge($querys, ['sort'=>6]))}}"><div class="sort-item sale"><span class={{isset($querys['sort']) && $querys['sort']==6 ? 'def' : ''}}>销量</span></div></a>

    @if(isset($querys['sort']) && ($querys['sort']==3 || $querys['sort']==4))
        <a href="{{route('mobile.index.index', array_merge($querys, ['sort'=>12/$querys['sort']]))}}"><div class="sort-item price"><span class="def">价格</span></div></a>
    @else
        <a href="{{route('mobile.index.index', array_merge($querys, ['sort'=>3]))}}"><div class="sort-item price"><span>价格</span></div></a>
    @endif

</div>
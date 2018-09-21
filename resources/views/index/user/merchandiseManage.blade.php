@extends('index.layout.myprofile')

@section('style')
	@parent
	<style>
		.usergoods-container {
			background: #F7F7F7;
		}
		.usergoods-container-inner {
			background: white;
			border: 1px solid #E9E9E9;
		}
		.usergoods-container-inner img {
			width: 7rem;
			height: 7rem;
		}
		.usergoods-item {
			height: 8rem;
			padding: 0.5rem;
			border-top: 1px solid #E9E9E9;
		}
		.usergoods-header span {
			float: left;
			width: 6rem;
			list-style: none;
			text-align: center;
			margin-left: 0.25rem;
		}
		.usergoods-header {
			height: 3rem;
			line-height: 2.8rem;
			background: white;
		}
		.usergoods-container .goods-info {
			line-height: 7rem;
		}
		.usergoods-container .goods-info span {
			text-align: center;
			width: 6rem;
			display: inline-block;
		}
		.usergoods-container .img-box {
			overflow: hidden;
			width: 7rem;
			display: inline;
		}
	</style>
@endsection
@section('content')
<div class="myprofile-board">
	<i class="fa fa-shopping-bag fa-fw"></i>&nbsp; 商品管理
	<hr>
	<div>
		<a href="{{route('index.myprofile.merchandiseManage', ['show_type'=>0])}}">
			<button class="btn {{$show_type==0 ? 'btn-orange' : ''}}">全部</button>
		</a>
		<a href="{{route('index.myprofile.merchandiseManage', ['show_type'=>1])}}">
			<button class="btn {{$show_type==1 ? 'btn-orange' : ''}}">已展示</button>
		</a>
		<a href="{{route('index.myprofile.merchandiseManage', ['show_type'=>2])}}">
			<button class="btn {{$show_type==2 ? 'btn-orange' : ''}}">待审核</button>
		</a>
		<a href="{{route('index.myprofile.merchandiseManage', ['show_type'=>3])}}">
			<button class="btn {{$show_type==3 ? 'btn-orange' : ''}}">已下架</button>
		</a>
		<a href="{{route('index.myprofile.merchandiseManage', ['show_type'=>4])}}">
			<button class="btn {{$show_type==4 ? 'btn-orange' : ''}}">已拒绝</button>
		</a>
	</div>
	<br>
	<div class="usergoods-container">
		<div class="usergoods-container-inner">
			<div class="usergoods-header">
					<span style="width: 7.5rem;">图片</span>
					<span>标题</span>
					<span>上架</span>
					<span>销量</span>
					<span>原价</span>
					<span>券后价</span>
					<span>优惠券</span>
					<span>计划</span>
					<span>操作</span>
			</div>
			@foreach($user_goods as $goods)
				<div class="usergoods-item">
					<div class=" goods-info">
						<a href="{{route('goods.detail', ['id'=>$goods->goods_id])}}"><img src="{{$goods->main_img}}" alt=""></a>
						<span style="width: 6rem;">{{mb_substr($goods->title, 0, 4).'...'}}</span>
						<span>{{$goods->onsale ? '是' : '否' }}</span>
						<span>{{$goods->sale_num}}</span>
						<span>{{$goods->origin_price}}</span>
						<span>{{$goods->after_price}}</span>
						<span>{{$goods->coupon_amount}}</span>
						<span>{{$goods->rate}}</span>
						<span>
							@if($goods->status == 1)
								@if($goods->onsale == 1)
									<button class="btn-sm btn-orange btn-op" data-id="{{$goods->id}}" data-type="down">下架</button>
								@else
									<button class="btn-sm btn-orange btn-op" data-id="{{$goods->id}}" data-type="up">上架</button>
								@endif
							@endif
							<button class="btn-sm btn-orange btn-op" data-id="{{$goods->id}}" data-type="del">删除</button>
						</span>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<br>
	<div>
		{{$user_goods->links()}}
	</div>
</div>
@endsection

@section('js')
	@parent
	<script>
		$(document).on('click', '.btn-op',function () {
		    var sure = confirm('确定执行该操作吗？');
		    if (sure) {
                var id = $(this).data('id');
                var op_type = $(this).data('type');
                $.ajax({
                    type: 'get',
                    url: '{{route('index.usergoods.goodsOperation')}}',
                    data: {'id':id, 'op_type':op_type},
                    success: function (res) {
                        console.log(res);
                        if (res.status) {
                            alert(res.msg);
                            location.reload();
                        }
                    }
                });
			}
        });
	</script>
@endsection
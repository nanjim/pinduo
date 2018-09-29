@extends('index.layout.myprofile')

@section('style')
	@parent
	<style>
		.star-list {
			border: 1px solid #E5E5E5;
			padding-bottom: 2rem;
		}
		.star-item {
			margin-top: 2rem;
			margin-left: 2rem;
			width: 45%;
			padding: 1rem;
			border: 1px solid #E5E5E5;
		}
		.goods-img {
		}
		.goods-info {
		}
		.star-item img {
			width: 100%;
		}
		.goods-info {
			margin-left: 0.5rem;
		}
		.col-7, .col-4 {
			padding: 0;
		}
		.text-lg {
			font-size: 18px;
		}
		.text-sm {
			font-size: 12px;
		}
	</style>
@endsection

@section('content')
<div class="myprofile-board">
	<i class="fa fa-camera-retro fa-fw"></i> 全部收藏
	<hr>
	@if(empty($stars))
		<div class="text-muted text-center">暂未有收藏商品</div>
	@else
	<div class="" style="">
		<button class="pull-right btn btn-orange btn-clear"   style="margin-left: 1rem">清空</button>
		<button class="pull-right btn btn-default btn-del">删除</button>
	</div>
	<br>
	<br>
	<div>
		<div class="star-list d-flex flex-wrap justify-content-start">
			@foreach($stars as $star)
				<div class="star-item row">
					<div class="" style="height: 2rem;width: 100%" data-goods_id="{{$star->id}}">
						<input name="star" type="checkbox" style="font-size: 30px;">
					</div>
					<div class="goods-img col-4">
						<a href="{{route('goods.detail', ['id'=>$star->goods_id])}}">
							<img src="{{$star->main_img}}" alt="">
						</a>
					</div>
					<div class="pull-left goods-info col-7">
						<span class="text-muted">  {{strlen($star->title) < 16 ? $star->title : mb_substr($star->title, 0, 16).'...'}}</span><br>
						<span class="text-red text-lg">{{'￥'.$star->after_price}}</span>
						<s class="text-muted">{{'￥'.$star->origin_price}}</s>
						<span class="text-muted pull-right text-sm">销量{{$star->sale_num}}</span>
						<div class="commission row goods-item text-sm">
							<div class="jin col-md-6 border border-top-0 border-left-0 border-bottom-0">
								<div class="text-center">￥{{$star->commission}}</div>
								<div class="text-center"><i class="fa fa-money" aria-hidden="true"></i> 佣金</div>
							</div>
							<div class="plan col-md-6 text-sm">
								<div class="text-center">{{$star->rate}}%</div>
								<div class="text-center"><i class="fa fa-btc" aria-hidden="true"></i> 计划</div>
							</div>
						</div>
						<div class="coupon-msg goods-item">
							<span>
								<i class="fa fa-ticket" aria-hidden="true"></i> ￥{{$star->coupon_amount}}
							</span>
										<span class="pull-right">
								余{{$star->coupon_remain}}
							</span>
							<div class="progress" style="height: 3px">
								<div class="progress-bar" style="width:{{$star->coupon_num > 0 ? ($star->coupon_num-$star->coupon_remain)/$star->coupon_num*100 : 0}}%;">
								</div>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>
	@endif
</div>
@endsection

@section('js')
	@parent
	<script>
		$(document).ready(function () {
            $(".btn-del").click(function () {
                var goods_ids = [];
                $('input[name=star]:checked').each(function () {
                    goods_ids.push($(this).parent().data('goods_id'));
                });
                var sure = confirm('确定删除吗？');
                if (sure) {
                    $.ajax({
                        type: 'post',
                        url: "{{route('index.star.del')}}",
                        data: {'goods_ids': goods_ids, '_token': "{{csrf_token()}}"},
                        success: function (res) {
                            if (res.status) {
                                alert(res.msg);
                                location.reload();
                            }
                        }
                    });
				}
            });

            $('.btn-clear').click(function () {
				var sure = confirm('确定清空吗？');
				if (sure) {
                    $.ajax({
                        type: 'get',
                        url: '{{route('index.star.clear')}}',
                        success: function (res) {
                            if (res.status) {
                                alert(res.msg);
                                location.reload();
                            }
                        }
                    });
				}
            });
        });
	</script>
@endsection
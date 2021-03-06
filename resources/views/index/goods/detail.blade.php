@extends('index.layout.entry')
@section('style')
@parent
	<style>
		.goods-owner-box {
			padding: 0;
		}
		.goods-owner {
			padding: 1rem 0 0 0;
		}
		.detail-container {
			padding: 2rem 2rem;
		}
		.goods-owner img{
			width: 5rem;
			height: 5rem;
			border: solid #F8AB65;
			-webkit-border-radius: 50px;
			-moz-border-radius: 50px;
			border-radius: 50px;
		}
		.team-type {
			background: #F8AB65;
			color: white;
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			padding: 0.15rem;
			margin-left: 0.5rem;
		}
		.owner-name {
			font-weight: 600;
		}
		.owner-bottom {
			background: #E5E5E5;
			border-top: 1px solid #C0C0C0;
			height: 3rem;
		}
		.owner-bottom .item {
			width: 50%;
			float: left;
			text-align: center;
			padding: 0.3rem;
			height: 100%;
			font-size: 12px;
		}
		.owner-bottom .right {
			border-left: 1px solid #C0C0C0;
		}
		.coupon-line {
			padding-bottom: 1rem;
		}
		.spread-area img {
			width: 100%;
		}
	</style>
@endsection
@section('content')
	<div class="detail-container d-flex flex-wrap justify-content-around"> 

			@if(isset($team))
                <div class="card col-md-2 align-self-start goods-owner-box">
                    <div class="card-body text-center goods-owner">
						<a href="{{route('index.team_show', ['user_id'=>$team->user_id])}}"><img src="{{URL::asset('upload/'.$team->avatar)}}" alt=""></a>
                        <br><br>
                        <span class="owner-name">{{$team->name}}</span><span class="team-type">{{$team->type == 1 ? '个人' : '团队'}}</span>
						<br><br>
						<div class="owner-bottom">
							<div class="item">
								入驻时间
								<br>
								{{(int)((time() - strtotime($team->created_at))/86400 + 1)}} &nbsp;天
							</div>
							<div class="item right">
								在线商品
								<br>
								{{$team->goodsCount}} &nbsp;件
							</div>
						</div>
                    </div>

                </div>
            @endif
			<div class="card col-md-9">
				<div class="card-body ">
					<i class="fa fa-cube text-green" aria-hidden="true"></i><span> 商品详情</span>
					<hr>
					<div class="row">			
						<div class="col-md-5 align-self-start">
							<div class="goods-img">
								<img src="{{$data->goods_thumbnail_url}}" alt="">
							</div>
							<p></p>
							<div class="goods-imgs d-flex flex-wrap ">
								@foreach($data->goods_gallery_urls as $url)
									<img class="goods-img-thumb" src="{{$url}}" alt="">
								@endforeach
							</div>
						</div>
						<div class="col-md-7">
							<div class="goods_name">
								<p>
									{{$data->goods_name}}
								</p>
							</div>
							<div>
								<p>
									<span class="col-md-4">
										<span class="text-dark small-1">
											券后
										</span>
										<span class="text-red large-1">
											￥{{($data->min_group_price-$data->coupon_discount)/100}}
										</span>
									</span>
									<span class="col-md-3">
										原价<s class="price">￥{{$data->min_group_price/100}}</s>
									</span>
									<span class="sales text-mute col-md-2">销量{{$data->sold_quantity}}</span>
									<span class="score large-2 text-red col-md-3">{{$data->avg_desc}}分</span>
								</p>
							</div>
							<p class="solid"></p>
							<p class="row text-center coupon-line">
								<span class="col-md-4">
									<span class="shit rounded">券</span>
									<span class="shit-amount text-red">￥{{$data->coupon_discount/100}}</span></span>
								<span class="col-md-4">佣金
									<span class="text-red">￥{{round((($data->min_group_price-$data->coupon_discount)*$data->promotion_rate)/100000, 2)}}</span>
								</span>
								<span class="col-md-4">计划{{$data->promotion_rate/10}}%</span>
							</p>
							<p class="solid"></p>
								<p>
									<span>已领
										<span class="text-red">{{$data->coupon_total_quantity-$data->coupon_remain_quantity}}</span>/{{$data->coupon_total_quantity}}
									</span>张
								</p>
								<p>
									<span>优惠券有效时间 {{date('Y-m-d',$data->coupon_start_time)}} 至 {{date('Y-m-d',$data->coupon_end_time)}}
									</span>
								</p>
							<p class="dashed"></p>
							<p>
								{{$data->goods_desc}}
							</p>
						</div>
					</div>
					<br>
					<div>
						<p><i class="fa fa-copy text-green"></i> <b>推广文案</b></p>
					</div>
					<hr>
					<div class="spread-area row">
						<div class="col-3">
							<img src="{{$data->goods_thumbnail_url}}" alt="">
						</div>
						<div id="copy-text" class="col-9" style="">
							<p>{{$data->goods_name}}<br>
								【在售价{{$data->min_group_price/100}}元】券后【{{($data->min_group_price-$data->coupon_discount)/100}}元】</p>
							<p>{{$data->goods_desc}}</p>
							<p>下单链接：<a id="link" target="_blank" href="http://mobile.yangkeduo.com/goods2.html?goods_id={{$goods_id}}">http://mobile.yangkeduo.com/goods2.html?goods_id={{$goods_id}}</a></p>
							<p class="text-center"><button data-clipboard-target="#copy-text" class="btn btn-success copy-btn">一键复制</button></p>
						</div>
					</div>
				</div>

			</div>
	</div>
@endsection

@section('js')
@parent
<script src="https://cdn.bootcss.com/clipboard.js/2.0.0/clipboard.min.js"></script>
<script>
	$(function(){

		$('.goods-img-thumb').hover(function(){
			$(this).css('border',"solid green");
			var src = $(this).attr('src');
			$('.goods-img img').attr('src',src);
		},function(){
			$(this).css('border',"none");
		});


        var clipboard = new ClipboardJS('.copy-btn');
        clipboard.on('success',function(e) {
            e.clearSelection();
            if (e.trigger.disabled == false || e.trigger.disabled == undefined) {
                e.trigger.innerHTML = "复制成功";
                e.trigger.style.backgroundColor = "#9ED29E";
                e.trigger.style.borderColor = "#9ED29E";
                e.trigger.disabled = true;
                setTimeout(function() {
                        e.trigger.innerHTML = "一键复制";
                        e.trigger.style.backgroundColor = "green";
                        e.trigger.style.borderColor = "green";
                        e.trigger.disabled = false;
                    },
                    2000);
            }
        });
        clipboard.on('error',function(e) {
            e.trigger.innerHTML = "复制失败,请手动复制";
            e.trigger.style.backgroundColor = "#8f8f8f";
            e.trigger.style.borderColor = "#8f8f8f";
        });
	})


</script>
@endsection
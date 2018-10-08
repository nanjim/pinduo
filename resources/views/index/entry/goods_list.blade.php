@foreach($data as $item)
			
	<div class="card goods" data-id="{{$item->goods_id}}">
		<div class="card-body">
			<a class="goods-img" href="{{route('goods.detail',['id'=>$item->goods_id])}}" target="_blank">
				<img src="{{$item->goods_thumbnail_url}}" alt="">
			</a>
			<span class="star"><i v-on:click="star($event)" data-id="{{$item->goods_id}}" class="fa fa-star-o star-icon"></i></span>
			<div class="goods-item goods-name">
				{{mb_substr($item->goods_name,0,30)}}
			</div>
			<div class="commission row goods-item">
				<div class="jin col-md-6 border border-top-0 border-left-0 border-bottom-0">
					<div class="text-center">￥{{round(($item->min_group_price-$item->coupon_discount)/100*$item->promotion_rate/1000,2)}}</div>
					<div class="text-center"><i class="fa fa-money" aria-hidden="true"></i> 佣金</div>
				</div>
				<div class="plan col-md-6">
					<div class="text-center">{{$item->promotion_rate/10}}%</div>
					<div class="text-center"><i class="fa fa-btc" aria-hidden="true"></i> 计划</div>
				</div>
			</div>
			<div class="coupon-msg goods-item">
				<span>
					<i class="fa fa-ticket" aria-hidden="true"></i> ￥ {{($item->min_group_price-$item->coupon_discount)/100}}
				</span>
				<span class="pull-right">
					余{{$item->coupon_remain_quantity > 0 ?: 0}}/{{$item->coupon_total_quantity ?: 0}}
				</span>
				<div class="progress" style="height: 3px">
			    	<div class="progress-bar" style="width:{{$item->coupon_total_quantity > 0 ? ($item->coupon_total_quantity-$item->coupon_remain_quantity)/$item->coupon_total_quantity*100 : 0}}%;">
			    	</div>
			  	</div>
			</div>
			<div class="price goods-item">
				<span>券后</span>￥ {{$item->coupon_discount/100}}
				<!-- <span><button>复制文案</button></span> -->
				<span class="pull-right">销量{{$item->sold_quantity}}</span>
			</div>
			
		</div>
		<!-- <div class="goods-item goods-desc card-footer rounded-bottom">
				dsadasds
		</div> -->
	</div>

@endforeach



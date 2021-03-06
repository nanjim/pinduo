@if(!$goodsList->totalSize>0)
    暂未找到相关产品
@else
@foreach($goodsList as $goods)
    <div class="goods-item card {{$goods->type == 0 ? 'user-goods' : ''}}" data-id="{{$goods->id}}" data-goods_id="{{$goods->goods_id}}">
        <div class="card-body">
            <a class="goods-img" href="{{route('goods.detail', ['id'=>$goods->goods_id])}}" target="_blank">
                <img src="{{URL::asset($goods->main_img)}}" alt="">
            </a>
            <span class="star"><i v-on:click="star($event)" data-id="{{$goods->goods_id}}" class="fa fa-star-o star-icon"></i></span>
            <div class="goods-item goods-name">
                {{mb_substr($goods->title,0,30)}}
            </div>
            <div class="commission row goods-item">
                <div class="jin col-md-6 border border-top-0 border-left-0 border-bottom-0">
                    <div class="text-center">￥{{$goods->commission}}</div>
                    <div class="text-center"><i class="fa fa-money" aria-hidden="true"></i> 佣金</div>
                </div>
                <div class="plan col-md-6">
                    <div class="text-center">{{$goods->rate}}%</div>
                    <div class="text-center"><i class="fa fa-btc" aria-hidden="true"></i> 计划</div>
                </div>
            </div>
            <div class="coupon-msg goods-item">
				<span>
					<i class="fa fa-ticket" aria-hidden="true"></i> ￥{{$goods->coupon_amount}}
				</span>
                <span class="pull-right">
					余{{$goods->coupon_remain}}
				</span>
                <div class="progress" style="height: 3px">
                    <div class="progress-bar" style="width:{{$goods->coupon_num > 0 ? ($goods->coupon_num-$goods->coupon_remain)/$goods->coupon_num*100 : 0}}%;background: #FF6100;">
                    </div>
                </div>
            </div>
            <div class="price goods-item">
                <span style="color: #8D8D8D;"><span>原价</span><s>￥{{$goods->origin_price}}</s></span><br>
                <span>券后</span>￥{{$goods->after_price}}
                <span class="pull-right">销量{{$goods->sale_num}}</span>
            </div>
            @if($goods->type == 0)
            <br>
            <div class="text-center"><button data-toggle="tooltip" title="推荐：{{$goods->copy_text}}" data-clipboard-target="#copy-text" class="btn btn-orange btn-copy">复制文案</button></div>
            <div class="copy-area">
                {{$goods->copy_text}}
            </div>
            @endif
        </div>
        <div id="copy-text" class="copy_text hidden">
            推荐：{{$goods->copy_text}}
        </div>

    </div>

@endforeach
@endif
@section('js')
    @parent
    <script src="https://cdn.bootcss.com/clipboard.js/2.0.1/clipboard.min.js"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();

            var clipboard = new ClipboardJS('.btn-copy', {
                'text': function (trigger) {
                    tar = trigger.parentNode.nextSibling.nextSibling.innerHTML;
                    return tar;
                }
            });

            clipboard.on('success',function(e) {
                e.clearSelection();
                if (e.trigger.disabled == false || e.trigger.disabled == undefined) {
                    e.trigger.innerHTML = "复制成功";
                    e.trigger.style.backgroundColor = "#9ED29E";
                    e.trigger.style.borderColor = "#9ED29E";
                    e.trigger.disabled = true;
                    setTimeout(function() {
                            e.trigger.innerHTML = "复制文案";
                            e.trigger.style.backgroundColor = "#FB8A05";
                            e.trigger.style.borderColor = "#FB8A05";
                            e.trigger.disabled = false;
                        },
                        2000);
                }
            });
        });
        $(document).on('mouseover', '.user-goods', function () {
            $copy_board = $(this).find('.copy_text');
            $copy_board.removeClass('hidden');
            $(this).css({'border-radius': '5px 5px 0 0', 'border': '1px solid orange', 'border-bottom': 'none'});
            $copy_board.css({'border': '1px solid orange', 'border-top': '1px solid #E9E9E9', 'border-radius': '0 0 5px 5px'});
        });
        $(document).on('mouseout', '.user-goods', function () {
            $copy_board = $(this).find('.copy_text')
            $copy_board.addClass('hidden');
            $(this).css({'border-radius': '5px', 'border': '1px solid #E8E6E6'});
        });


    </script>
@endsection
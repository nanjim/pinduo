@extends('mobile.layout.searchWrap')

@section('content')
<div class="content-wrap">

        <div class="list-item">

        </div>

</div>
@endsection

@section('js')
<script>

    document.onkeydown = function () {
        var theEvent = window.event;
        var code = theEvent.keyCode || theEvent.which || theEvent.charCode;
        if (code == 13) {
            $("#search-form").submit();
            return false;
        }
        return true;
    }

    var mescroll = new MeScroll('list',{
        down:{
            isLock:true,
        },
        up:{
            callback:upCallback,
            isBounce: false,
            page:{'num':0,'size':10}
        }
    });

    function upCallback(page){

        var url = "{{route('mobile.index.getSearchGoods')}}";
        var sort = "{{isset($querys['sort']) ? $querys['sort'] : 0}}";
        var q = "{{isset($querys['q']) ? $querys['q'] : ''}}";
        $.ajax({
            type:"get",
            url: url,
            data:{'num':page.num,'size':page.size,'sort':sort,'q':q},
            success: function(data) {
                mescroll.endBySize(data.length, data.total_size);
                setListData(data.goods_list);
            },
            error: function(data) {
                mescroll.endErr();
            },

        });
    }

    function setListData(data){
        for(var i=0;i<data.length;i++){
            var goods = '<div class="goods-item item-6"><div class="goods-inner-item"><a class="goods-item-a" target="_blank" href="http://mobile.yangkeduo.com/goods2.html?goods_id='+data[i].goods_id+'">' +
                '<img src="'+data[i].goods_thumbnail_url+'">' +
                '<div class="goods-title"><span>' + data[i].goods_name.substr(0,20) + '</span></div>' +
                '<p><span class="after-price">￥' + ((data[i].min_group_price-data[i].coupon_discount)/100) + '</span>' +
                '<s class="origin-price">￥' + (data[i].min_group_price/100) + '</s></p>' +
                '<p><span class="coupon">' + data[i].coupon_discount/100 + '元优惠券</span>' +
                '<span class="sale">销量' + data[i].sold_quantity + '</span></p>' +
                '</a>' +
                '</div></div>';
            $(".list-item").append(goods);
        }
    }
</script>
@endsection
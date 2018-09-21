@extends('index.layout.myprofile')

@section('content')
<div class="myprofile-board add-spread">
	<div class="card">
		<div class="card-header">发布推广</div>
		<div class="card-body">
			<div class="row">
				<div class="col-7">
					<input type="text" class="form-control" placeholder="例如：http://mobile.yangkeduo.com/goods2.html?goods_id=2595890204" name="link">
				</div>
				<div class="text-center col-3">
					<button type="submit" class="btn btn-orange btn-get-info">获取信息</button>
				</div>
			</div>
			<form action="{{route('index.postSpread')}}" method="post" id="goods-form">

			</form>
		</div>
	</div>
</div>
@endsection

@section('js')
	<script>
		var status = "{{session('status')}}";
		if (status) {
		    alert('添加成功');
		}
        $(document).on('click', '.btn-get-info', function () {
			var link = $('input[name=link]').val();
			if(link.trim() == ''){
			    alert('链接不能为空');
			}else{
			    var reg = new RegExp('goods_id=\\d{5,}');
			    var id_str = reg.exec(link);
			    var id_reg = new RegExp('\\d{5,}');
			    var id = id_reg.exec(id_str);
                $.ajax({
                    type: 'get',
                    url: "{{route('index.myprofile.addSpread')}}",
					data: {'link': link},
                    success: function (data) {
						console.log(data);
						if(!data.status){
						    alert(data.msg);
						}else{

						    var goods = data.data.data;
						    var start_time = toNormalTime(goods.coupon_start_time);
						    var end_time = toNormalTime(goods.coupon_end_time);
						    var imgs = '';
						    var post_imgs = '<input name="imgs" type="hidden" value="'+goods.goods_gallery_urls+'" />';
						    var post_main_img = '<input name="main_img" type="hidden" value="'+goods.goods_thumbnail_url+'" />';
						    var options = '';
						    var main_img = '<img id="main-img" class="col-4" src="'+goods.goods_thumbnail_url+'">';
							var goods_imgs = goods.goods_gallery_urls;

						    for(var i=0; i<goods_imgs.length; i++){
								imgs += '<img src="'+goods_imgs[i]+'" class="col-3">';
							}

							for(var i=0; i<data.cats.length; i++){
						        options += '<option value="'+data.cats[i].id+'">'+data.cats[i].name+'</option>';
							}
							var goodsInfo = '<div class="form-group">' +
												'<label>商品主图</label>' +
												'<div class="goods-img col-10">' +
                                					main_img +
												'</div>' +
											'</div>' +
											'<div class="form-group">' +
												'<label>图片展示</label>' +
												'<div class="goods-img col-12">' +
													imgs +
												'</div>' +
											'</div>' +
											'<div class="form-group">' +
												'<label>商品标题</label>' +
												'<input name="title" type="text" class="form-control" placeholder="请输入短标题">' +
											'</div>' +
											'<div class="form-group">' +
												'<label>所属分类</label>' +
												'<select class="form-control" name="cat_id">' +
													options +
												'</select>' +
											'</div>' +
                                			'<div class="form-group row">' +
												'<div class="col-3"><label>商品评分</label>'+'<input readonly="readonly" name="score" value="'+goods.goods_eval_score+'" />'+ '</div>' +
												'<div class="col-3"><label>销量</label>'+'<input readonly="readonly" name="sale_num" value="'+goods.sold_quantity+'" />'+'</div>' +
												'<div class="col-3"><label>原价</label>'+'<input readonly="readonly" name="origin_price" value="'+goods.min_group_price/100+'" />'+'</div>' +
												'<div class="col-3"><label>券后价</label>'+'<input readonly="readonly" name="after_price" value="'+(goods.min_group_price - goods.coupon_discount)/100+'" />'+'</div>' +
                                			'</div>' +
											'<div class="form-group row">' +
												'<div class="col-3"><label>优惠券金额</label>'+'<input readonly="readonly" name="coupon_amount" value="'+goods.coupon_min_order_amount/100+'" />'+'</div>' +
												'<div class="col-3"><label>优惠券总数</label>'+'<input readonly="readonly" name="coupon_num" value="'+goods.coupon_total_quantity+'" />'+'</div>' +
												'<div class="col-3"><label>优惠券剩余</label>'+'<input readonly="readonly" name="coupon_remain" value="'+goods.coupon_remain_quantity+'" />'+'</div>' +
												'<div class="col-3"><label>佣金比例</label>'+ '<input readonly="readonly" name="rate" value="'+goods.promotion_rate/10+'" />'+'%</div>' +
											'</div>' +
											'<div class="form-group row">' +
												'<div class="col-6"><label>优惠券开始时间</label>'+'<input style="width: 10rem" readonly="readonly" name="start_time" value="'+start_time+'" />'+'</div>' +
												'<div class="col-6"><label>优惠券结束时间</label>'+'<input style="width: 10rem" readonly="readonly" name="end_time" value="'+end_time+'" />'+'</div>' +
											'</div>' +
											'<div class="form-group col-5">' +
												'<label>导购文案</label>' +
												'<textarea class="form-control" cols="6" rows="5" name="copy_text"></textarea>' +
											'</div>' +
											'<input type="hidden" value="' + id + '" name="goods_id" >' +
                                			post_imgs +
                                			post_main_img +
											'@csrf' +
											'<button type="submit" class="btn btn-primary">提交</button>';

							$('#goods-form').html(goodsInfo);
						}
                    }
                });
			}

        });

        function toNormalTime(timestamp) {
            var d = new Date(timestamp*1000);
			var year = d.getFullYear();
			var month = d.getMonth() > 10 ? (d.getMonth()+1) : ('0'+(d.getMonth()+1));
			var date = d.getDate() > 10 ? d.getDate() : ('0'+d.getDate());
			var hour = d.getHours() > 10 ? d.getHours() : ('0'+d.getHours());
			var minute = d.getMinutes() > 10 ? d.getMinutes() : ('0'+d.getMinutes());
			var second = d.getSeconds() > 10 ? d.getSeconds() : ('0'+d.getSeconds());
			return year + '-' + month + '-' + date + ' ' + hour + ':' + minute + ':' + second;
		}
	</script>
@endsection
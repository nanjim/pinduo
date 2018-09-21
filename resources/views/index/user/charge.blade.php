@extends('index.layout.myprofile')

@section('style')
	@parent
	<style>
		.charge-box {
			height: 15rem;
		}
		.cny-item {
			border: 1px solid #D6D4D4;
			width: 26%;
			padding: 1rem;
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
			text-align: center;
			margin: 1rem;
		}
		.cny-item:hover{
			cursor: pointer;
		}
		.on-sel {
			background-color: #FFF0E0;
			border: 1px solid #F97C12;
		}

		.cny {
			font-weight: 500;
			font-size: 20px;
		}
		.integral {
			color: #5F5F5F;
		}
	</style>
@endsection
@section('content')
<div class="myprofile-board">
	<i class="fa fa-cny fa-fw"></i> 充值中心
	<hr>
	<form action="{{route('index.charge.postCharge')}}" method="post">
		{{csrf_field()}}
		<div class="row d-flex justify-content-around align-content-around charge-box">
			@foreach($charge_sets as $charge_set)
				<div class="cny-item">
					<div><span class="cny">{{$charge_set->cny}}</span>元</div>
					<div><span class="integral">{{$charge_set->integral}}</span>积分</div>
				</div>
			@endforeach
		</div>
		<input type="hidden" name="cny" value="">
		<input type="hidden" name="integral" value="">
		<div>
			<button class="btn btn-orange">支付宝充值</button>
		</div>
	</form>
</div>
@endsection

@section('js')
	@parent
	<script>
		$(document).on('click', '.cny-item', function () {
		    var cny = $(this).find('.cny').text();
		    var integral = $(this).find('.integral').text();
		    $("input[name=cny]").val(cny);
		    $("input[name=integral]").val(integral);
		    $('.cny-item').each(function () {
				if ($(this).hasClass('on-sel')) {
				    $(this).removeClass('on-sel');
				}
            });
			$(this).addClass('on-sel');
        });


	</script>
@endsection
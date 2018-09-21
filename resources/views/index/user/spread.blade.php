@extends('index.layout.myprofile')

@section('content')
<div class="myprofile-board">
	<div>
		<div class="card">
			<div class="card-header">招商放单申请</div>
			<div class="card-body">
				<form action="{{route('index.spread')}}" method="post">
                    {{csrf_field()}}
					<div class="form-group row">
						<div class="col-md-4 offset-3 text-center">
							<input type="radio" class="" name="type" value="1" checked {{old('type')==1 ? 'checked' : ''}}> 个人
						</div>
						<div class="col-md-4">
							<input type="radio" name="type" value="2" class="" {{old('type')==2 ? 'checked' : ''}}> 团队
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">个人/团队名称</label>
						<div class="col-md-4">
							<input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('name')}}">
                            @if($errors->has('name'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            @endif
                        </div>
					</div>
                    <div>
                    </div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">QQ</label>
						<div class="col-md-4">
							<input type="text" name="qq" class="form-control{{ $errors->has('qq') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('qq')}}" >
                            @if($errors->has('qq'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('qq')}}</strong>
                                </span>
                            @endif
                        </div>
					</div>

					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">微信号</label>
						<div class="col-md-4">
							<input type="text" name="weixin" class="form-control{{ $errors->has('weixin') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('weixin')}}">
                            @if($errors->has('weixin'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('weixin')}}</strong>
                                </span>
                            @endif
						</div>
					</div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">月收入</label>
						<div class="col-md-2">
							<input type="text" name="income" class="form-control{{ $errors->has('income') ? ' is-invalid' : '' }}" autocomplete="off" value="{{old('income')}}">
                            @if($errors->has('income'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('income')}}</strong>
                                </span>
                            @endif
                        </div>
						<div class="col-md-1 control-label">
							万
						</div>
					</div>
                    <div>
                    </div>
					<div class="form-group row">
						<label class="offset-2 control-label col-md-2">个人/团队介绍</label>
						<div class="col-md-4">
							<textarea name="desc" cols="30" rows="5" class="form-control{{ $errors->has('desc') ? ' is-invalid' : '' }}">{{old('desc')}}</textarea>
                            @if($errors->has('desc'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('desc')}}</strong>
                                </span>
                            @endif
                        </div>
					</div>
                    <div>
                    </div>
					<div class="text-center">
						<button type="submit" class="btn btn-orange">提交</button>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>
@endsection
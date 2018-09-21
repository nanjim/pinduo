@extends('index.layout.myprofile')

@section('content')
<div class="myprofile-board ">
	<div class="col-md-8">
		@if(session('success'))
			<div class="alert alert-success">
		    	<i class="fa fa-check"></i>{{session('success')}}
		    </div>
		@endif
		
		<div class="card">
			<div class="card-header">
				修改密码
			</div>
			<div class="card-body">
				<form action="{{route('index.postModifyPassword')}}" method="post">

					@csrf

				    <div class="form-group row">
				  		<label class="col-md-4 control-label">原密码：</label>
				   		<div class="col-md-5">
				   			<input type="text" class="form-control {{$errors->has('origin_password') ? 'is-invalid' : ''}}" id="origin_password" autocomplete="off" name="origin_password" value="{{ old('origin_password') }}">
				   			@if( $errors->has('origin_password') )
					        	<span class="invalid-feedback">{{$errors->first('origin_password')}}</span>
							@endif
				   		</div>
				    </div>

				    <div class="form-group row">
				  		<label class="col-md-4 control-label">新密码：</label>
				   		<div class="col-md-5">
				   			<input type="text" class="form-control {{$errors->has('new_password') ? 'is-invalid' : ''}}" autocomplete="off" id="new_password" name="new_password">
				   			@if( $errors->has('new_password') )
					       		<span class="invalid-feedback">{{$errors->first('new_password')}}</span>
							@endif
				   		</div>
				    </div>
				    
				    <div class="form-group row">
				  		<label class="col-md-4 control-label">确认密码：</label>
				  		
				   		<div class="col-md-5">
				   			<input type="text" class="form-control " autocomplete="off" id="sure_password" name="new_password_confirmation">
				   		</div>
				    </div>
					
				    <div class="offset-md-5">
				    	<button type="submit" class="btn btn-success">确认修改</button>
				    </div>

				</form>
			</div>
			
		</div>
	</div>
</div>
@endsection
@extends('layouts.app')
<style>
    #bg {
        position: absolute;
        width: 100%;
    }
</style>
@section('content')
    <img id="bg" src="{{asset('img/login_bg.png')}}" alt="">

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 offset-md-7" style="margin-top: 2rem">
            <div class="card">
                <div class="card-header">{{ __('登录') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="mobile" class="col-sm-3 col-form-label text-md-right">{{ __('手机号') }}</label>

                            <div class="col-md-7">
                                <input id="mobile" type="text" class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}" name="mobile" value="{{ old('mobile') }}" autofocus autocomplete="off">

                                @if ($errors->has('mobile'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('密码') }}</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" autocomplete="off">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('验证码') }}</label>

                            <div class="col-md-3">
                                <input id="captcha" type="text" class="form-control{{ $errors->has('captcha') ? ' is-invalid' : '' }}" name="captcha" autocomplete="off">

                                @if ($errors->has('captcha'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <img src="{{captcha_src()}}" title="点击切换" class="thumbnail" style="cursor: pointer;" onclick="this.src='{{captcha_src()}}?'+Math.random()">
                            </div>
                        </div>

                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-6 offset-md-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('登录') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.getReset') }}">
                                    {{ __('忘记密码?') }}
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var status = "{{session('status')}}";
        if (status) {
            alert('修改成功');
        }
    </script>
@endsection

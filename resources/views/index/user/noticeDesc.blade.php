@extends('index.layout.myprofile')

@section('content')
<div class="myprofile-board">
	<i class="fa fa-camera-retro fa-fw"></i> 消息详情
	<hr>
	<div class="bg">
        <div class="notice-desc-box">
            <p class="notice-title">{{$notice->title}}
            </p>
            <hr>
            <p class="notice-desc">{{$notice->desc}}</p>
            <p class="text-right text-muted">{{$notice->created_at}}</p>
        </div>
	</div>
</div>
@endsection

@section('js')
    <script>

    </script>
@endsection
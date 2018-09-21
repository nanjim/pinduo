@extends('index.layout.myprofile')

@section('content')
<div class="myprofile-board">
	<i class="fa fa-camera-retro fa-fw"></i> 我的消息
	<hr>
	<div class="bg">
        @foreach($notices as $notice)
            <a href="{{route('index.myprofile.noticeDesc', ['id'=>$notice->id])}}">
                <div class="notice-item">
                    <p class="notice-title">{{$notice->title}}
                        @if($notice->is_read == 0)
                            <span class="badge badge-pill badge-danger pull-right">new</span>
                        @endif
                    </p>
                    <hr>
                    <p class="notice-desc">{{mb_substr($notice->desc, 0, 180).'...'}}</p>
                    <p class="text-right text-muted">{{$notice->created_at}}</p>
                </div>
            </a>
        @endforeach
	</div>
    <div class="links">
        {{$notices->links()}}
    </div>
</div>
@endsection

@section('js')
    <script>

    </script>
@endsection
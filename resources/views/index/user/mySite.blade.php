@extends('index.layout.myprofile')

@section('content')
<div class="myprofile-board">
	<i class="fa fa-camera-retro fa-fw"></i> 我的网站
	<hr>
	<div>
        <form action="{{route('index.myprofile.keepSiteTitle')}}" method="post">
            @csrf
            <div class="form-group row">
                <label class="col-2 control-label">我的网站名称：</label>
                <div class="col-8">
                    <input id="title" name="title" type="text" class="form-control" value="{{$site->title}}">
                </div>
                <button type="button" class="btn btn-primary change-title  btn-mysite">确定</button>
            </div>
        </form>
        <hr>

        <div class="form-group row">
            <label class="col-2 control-label">我的网站链接：</label>
            <div class="col-8">
                <input name="link" id="copy-content" readonly type="text" class="form-control" value="{{$site->shortlink}}">
            </div>
            <button type="submit" class="btn btn-primary btn-mysite btn-copy" data-clipboard-target="#copy-content">一键复制</button>
        </div>

	</div>
</div>
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/clipboard.js/2.0.1/clipboard.min.js"></script>
    <script>
        $(document).on('click', '.change-title', function () {
            var title = $('#title').val();
            var token = "{{csrf_token()}}";
            $.ajax({
                type: 'post',
                url: '{{route('index.myprofile.changeTitle')}}',
                data: {'title': title, '_token': token},
                success: function (data) {
                    console.log(data);
                    if (data.status) {
                        location.reload();
                    }
                }
            });
        });

            var clipboard = new ClipboardJS('.btn-copy');
            clipboard.on('success',function(e) {
                if (e.trigger.disabled == false || e.trigger.disabled == undefined) {
                    e.trigger.innerHTML = "复制成功";
                    e.trigger.style.backgroundColor = "#9ED29E";
                    e.trigger.style.borderColor = "#9ED29E";
                    e.trigger.disabled = true;
                    setTimeout(function() {
                            e.trigger.innerHTML = "一键复制";
                            e.trigger.style.backgroundColor = "#FF6500";
                            e.trigger.style.borderColor = "#FF6500";
                            e.trigger.style.color = "white";
                            e.trigger.disabled = false;
                        },
                        2000);
                }
            });
            clipboard.on('error',function(e) {
                e.trigger.innerHTML = "复制失败,请手动复制";
                e.trigger.style.backgroundColor = "#8f8f8f";
                e.trigger.style.borderColor = "#8f8f8f";
            });
    </script>
@endsection
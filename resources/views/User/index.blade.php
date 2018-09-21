{{--@for($i=0;$i<)--}}
{{--{{$admins}}--}}
@foreach($users as $val)
    {{$val->username}}
    @if($loop->index==1)
        {{$loop->remaining}}
    @endif
@endforeach
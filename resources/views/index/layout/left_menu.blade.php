<div class="user-center">
    <div class="left-menu">
        <ul class="">
            <li>
                <a class="{{$item=='baseData' ? 'menu-now' : ''}}" href="{{route('index.myprofile.baseData')}}">
                    <i class="fa fa-address-card fa-fw"></i>&nbsp; 基本资料
                </a>
            </li>
            <li>
                <a class="{{$item=='myNotice' ? 'menu-now' : ''}}" href="{{route('index.myprofile.myNotice')}}">
                    <i class="fa fa-camera-retro fa-fw"></i>&nbsp; 我的消息
                    @if(session('msg_count') > 0)
                        <span class="badge badge-pill badge-danger">{{session('msg_count')}}</span>
                    @endif
                </a>
            </li>
            <li>
                <a class="{{$item=='modifyPassword' ? 'menu-now' : ''}}" href="{{route('index.myprofile.modifyPassword')}}">   <i class="fa fa-cog fa-fw"></i>&nbsp; 修改密码
                </a>
            </li>
            <li>
                <a class="{{$item=='spread' ? 'menu-now' : ''}}" href="{{route('index.myprofile.spread')}}">
                    <i class="fa fa-send fa-fw"></i>&nbsp; 发布推广
                </a>
            </li>
            <li>
                <a class="{{$item=='merchandiseManage' ? 'menu-now' : ''}}" href="{{route('index.myprofile.merchandiseManage')}}">
                    <i class="fa fa-shopping-bag fa-fw"></i>&nbsp; 商品管理
                </a>
            </li>
            <li>
                <a class="{{$item=='myCollection' ? 'menu-now' : ''}}" href="{{route('index.myprofile.myStar')}}">
                    <i class="fa fa-camera-retro fa-fw"></i>&nbsp; 我的收藏
                </a>
            </li>
            <li>
                <a class="{{$item=='mySite' ? 'menu-now' : ''}}" href="{{route('index.myprofile.mySite')}}">
                    <i class="fa fa-camera-retro fa-fw"></i>&nbsp; 我的网站
                </a>
            </li>
            <li>
                <a class="{{$item=='charge' ? 'menu-now' : ''}}" href="{{route('index.myprofile.charge')}}">
                    <i class="fa fa-cny fa-fw"></i>&nbsp; 充值中心
                </a>
            </li>
        </ul>
    </div>
</div>
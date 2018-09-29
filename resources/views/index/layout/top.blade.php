
<div class="top-line">
    @guest
        <a class="pull-right login-item" href="{{ route('register') }}">
            {{ __('注册') }}
        </a>
        <span class="pull-right sep">|</span>
        <a class="pull-right login-item" href="{{ route('login') }}">
            {{ __('登录') }}
        </a>
    @else
        <a class="pull-right login-item" href="{{ route('index.myprofile.baseData') }}">
            {{ __('个人中心') }}
        </a>
        <span class="pull-right sep">|</span>
        <a class="pull-right login-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.querySelector('#logout-form').submit();">
            {{ __('退出') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf<br>
        </form>
    @endguest
</div>
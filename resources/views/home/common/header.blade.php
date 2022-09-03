@php
    $navigations = \App\Models\NavigationBar::all();
    @endphp
<header id="header">
    <div class="container">
        <nav id="nav">
            <div class="logo">
                <a href="{{route('home')}}">
                    <img src="{{asset('images/logo.svg')}}" alt="LOGO">
                </a>
            </div>
            <a href="#" class="nav-opener"><i class="fal fa-close"></i> </a>
            <ul>
                <li><a href="/">Home</a></li>
                @foreach($navigations as $navigation)
                    @if($navigation->status == 'active')
                        @if($navigation->url == '#Apps')
                        <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#FAQ')
                        <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#Support')
                        <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#Price')
                        <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @elseif($navigation->url == '#OurPolicy')
                        <li><a href="{!! $navigation->url !!}">{!! $navigation->name !!}</a></li>
                        @else
                        <li><a href="{!!route('slug',$navigation->url)!!}">{!! $navigation->name !!}</a></li>
                        @endif
                    @endif
                @endforeach
                @guest
                <li><a href="" class="btn small" data-bs-toggle="modal" data-bs-target="#login">Login</a></li>
                @endguest
                @auth
                    <li><a href="{{route('logout')}}">Logout</a></li>
                @endauth
            </ul>
        </nav>
        <div class="logo">
            <a href="{{route('home')}}">
                <img src="{{asset('images/logo.svg')}}" alt="LOGO">
            </a>
        </div>
        <a href="" class="nav-opener nav-btn"><i class="fal fa-bars"></i></a>
    </div>
</header>



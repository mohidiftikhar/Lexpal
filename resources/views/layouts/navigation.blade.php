<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
            <a href="{{ route('admin.dashboard') }}">
                <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0 float-end">
                    <li class="nav-item">
                        <a href="{!! route('admin.dashboard') !!}" class="nav-link {!! request()->routeIs('dashboard')?'active':'' !!}">
                            {{ __('Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('flags.index') !!}" class="nav-link {!! request()->routeIs('flags.index')?'active':'' !!}">
                            {{ __('Flag') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('languages.index') !!}" class="nav-link {!! request()->routeIs('languages.index')?'active':'' !!}">
                            {{ __('Languages') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{!! route('csv.index') !!}" class="nav-link {!! request()->routeIs('csv.index')?'active':'' !!}">
                            {{ __('All Csv') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('licenses.index') !!}" class="nav-link {!! request()->routeIs('licenses.index')?'active':'' !!}">
                            {{ __('All Licenses') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('app_links.index') !!}" class="nav-link {!! request()->routeIs('app_links.index')?'active':'' !!}">
                            {{ __('All App Links') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('sliders.index') !!}" class="nav-link {!! request()->routeIs('sliders.index')?'active':'' !!}">
                            {{ __('All Sliders') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('question.index') !!}" class="nav-link {!! request()->routeIs('question.index')?'active':'' !!}">
                            {{ __('All Questions') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('products.index') !!}" class="nav-link {!! request()->routeIs('products.index')?'active':'' !!}">
                            {{ __('All Products') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{!! route('settings.create') !!}" class="nav-link {!! request()->routeIs('settings.create')?'active':'' !!}">
                            {{ __('Settings') }}
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Account
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="javascript:void(0)">{{ Auth::user()->name }}</a></li>
                            <li><a class="dropdown-item" href="{!! route('auth.profile') !!}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{!! route('auth.change-password') !!}">Change Password</a></li>
                                <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

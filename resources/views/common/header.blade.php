{{--<div class="container">--}}
{{--    <div class="grid">--}}
{{--        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">dfssfd</div>--}}
{{--        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">1dfssfd</div>--}}
{{--        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12">dfssfd</div>--}}
{{--        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12" style="text-align: right">dfssfddfssfddfssfddfssfddfssfd dfssfd dfssfd dfssfddfssfd dfssfddfssfd</div>--}}
{{--    </div>--}}
{{--</div>--}}


<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="logo header__logo">
                <a class="logo__link" href="{{ url('/') }}">
                    @include('inline-svg/site-icon', ['class' => 'header__site-icon'])
                    @include('inline-svg/site-name', ['class' => 'header__site-name'])
                </a>
            </div>

            <nav class="main-menu">
                <div class="main-menu__item">
                    <a class="button main-menu__link" href="#">Shelfs</a>
                </div>
                <div class="main-menu__item">
                    <a class="button main-menu__link" href="#">Blog</a>
                </div>
                <div class="main-menu__item">
                    <a class="button main-menu__link" href="#">Feed</a>
                </div>
                <div class="main-menu__item">
                    <a class="button main-menu__link" href="#">Users</a>
                </div>
                <div class="main-menu__item">
                    <a class="button button_submit main-menu__link" href="#">Add</a>
                </div>
            </nav>

            <div class="profile-menu">
                <div class="auth-menu">
                    @guest
                        @if(Route::currentRouteName() != 'login')
                            <div class="auth-menu__item">
                                <a class="button auth-menu__link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </div>
                        @endif
                        @if (Route::has('register') && Route::currentRouteName() != 'register')
                            <div class="auth-menu__item">
                                <a class="button auth-menu__link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </div>
                        @endif
                    @else
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>

    </div>
</header>

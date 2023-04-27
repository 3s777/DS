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
                    <a class="button main-menu__link" href="#">{{ __('Shelfs') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button main-menu__link" href="#">{{ __('Blog') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button main-menu__link" href="#">{{ __('Feed') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button main-menu__link" href="#">{{ __('Users') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button button_submit main-menu__link" href="#">{{ __('Add') }}</a>
                </div>
            </nav>

            <div class="profile-menu">
                <div class="profile-menu__inner">
                    <nav class="auth-menu">
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
                    </nav>

                    <div class="site-settings">
                        <div class="site-settings__inner" x-data="{ siteSettingsHidden: true }">
                            <div class="site-settings__button" x-on:click.stop="siteSettingsHidden = ! siteSettingsHidden" title="{{ __('Settings') }}">
                                @include('inline-svg/settings', ['class' => 'site-settings__icon'])
                            </div>
                            <div class="popover popover_tail_right site-settings__popover" x-on:click.outside="siteSettingsHidden = true" :class="siteSettingsHidden ? '' : 'site-settings__popover_visible'">
                                <div class="popover__inner">
                                    <div class="popover__title">
                                        {{ __('Choose language') }}
                                    </div>
                                    <div class="popover__content">
                                        <nav class="site-settings__flags">
                                            <a href="{{ route(Route::currentRouteName(), ['locale' => 'en']) }}">
                                                <div class="site-settings__flag @if(app()->getLocale() == 'en') site-settings__flag_active @endif">
                                                    @include('inline-svg/en', ['class' => 'site-settings__flag-icon'])
                                                </div>
                                            </a>
                                            <a href="{{ route(Route::currentRouteName(), ['locale' => 'ru']) }}">
                                                <div class="site-settings__flag @if(app()->getLocale() == 'ru') site-settings__flag_active @endif">
                                                    @include('inline-svg/ru', ['class' => 'site-settings__flag-icon'])
                                                </div>
                                            </a>
                                            <a href="{{ route(Route::currentRouteName(), ['locale' => 'ua']) }}">
                                                <div class="site-settings__flag @if(app()->getLocale() == 'ua') site-settings__flag_active @endif">
                                                    @include('inline-svg/ua', ['class' => 'site-settings__flag-icon'])
                                                </div>
                                            </a>
                                        </nav>
                                    </div>
                                    <div class="popover__title">
                                        {{ __('Choose theme color') }}
                                    </div>
                                    <div class="popover__content">
                                        <nav class="site-settings__colors">
                                            <a class="site-settings__color" href=""></a>
                                            <a class="site-settings__color site-settings__color_1" href=""></a>
                                            <a class="site-settings__color site-settings__color_2" href=""></a>
                                        </nav>
                                    </div>
                                    <div class="popover__close" x-on:click="siteSettingsHidden = true">
                                        @include('inline-svg/close', ['class' => 'popover__close-icon site-settings__popover-close'])
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
</header>

<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="logo header__logo">
                <a class="logo__link" href="{{ url('/') }}">
                    <x-svg.logo.site-icon class="header__site-icon"></x-svg.logo.site-icon>
                    <x-svg.logo.site-name class="header__site-name-icon"></x-svg.logo.site-name>
                </a>
            </div>

            <nav class="main-menu">
                <div class="main-menu__item">
                    <a class="button button_dark main-menu__link" href="#">{{ __('Shelfs') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button button_dark main-menu__link" href="#">{{ __('Blog') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button button_dark main-menu__link" href="#">{{ __('Feed') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button button_dark main-menu__link" href="#">{{ __('Users') }}</a>
                </div>
                <div class="main-menu__item">
                    <a class="button button_dark button_submit main-menu__link" href="#">{{ __('Add') }}</a>
                </div>
            </nav>

            <div class="profile-menu">
                <div class="profile-menu__inner">
                    <nav class="auth-menu">
                        @guest
                            @if(Route::currentRouteName() != 'login')
                                <div class="auth-menu__item">
                                    <a class="button button_dark auth-menu__link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </div>
                            @endif
                            @if (Route::has('register') && Route::currentRouteName() != 'register')
                                <div class="auth-menu__item">
                                    <a class="button button_dark auth-menu__link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </div>
                            @endif
                        @else
                            <div class="profile-menu__auth">
                                <x-ui.avatar
                                    class="profile-menu__avatar"
                                    link="{{ route('ui') }}"
                                    src="{{ asset('/storage/test-5.jpg') }}"
                                    username="{{ Auth::user()->name }}"
                                >
                                </x-ui.avatar>

                                <div class="profile-menu__links">
                                    <a class="profile-menu__username " href="#">
                                        {{--{{ Auth::user()->name }}--}} Александр Синица
                                    </a>

                                    <div class="profile-menu__logout">
                                        <a class="profile-menu__logout-link"
                                           href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();
                                        ">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                            @csrf
                                        </form>
                                    </div>
                                </div>

                            </div>
                        @endguest
                    </nav>

                    <div class="site-settings">
                        <div class="site-settings__inner" x-data="{ siteSettingsHidden: true }">
                            <div class="site-settings__button" x-on:click.stop="siteSettingsHidden = ! siteSettingsHidden" title="{{ __('Settings') }}">
                                <x-svg.settings class="site-settings__icon"></x-svg.settings>
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
                                                    <x-svg.flags.en class="site-settings__flag-icon"></x-svg.flags.en>
                                                </div>
                                            </a>
                                            <a href="{{ route(Route::currentRouteName(), ['locale' => 'ru']) }}">
                                                <div class="site-settings__flag @if(app()->getLocale() == 'ru') site-settings__flag_active @endif">
                                                    <x-svg.flags.ru class="site-settings__flag-icon"></x-svg.flags.ru>
                                                </div>
                                            </a>
                                            <a href="{{ route(Route::currentRouteName(), ['locale' => 'ua']) }}">
                                                <div class="site-settings__flag @if(app()->getLocale() == 'ua') site-settings__flag_active @endif">
                                                    <x-svg.flags.ua class="site-settings__flag-icon"></x-svg.flags.ua>
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

<div class="main-search">
    <div class="container">
        <div class="main-search" x-data="{ filters_hide: false }">
            <div class="main-search__header">
                <x-ui.input-search
                    wrapper_class="main-search__input-search"
                    link="{{ route('search') }}"
                    placeholder="{{ __('Что будем искать?') }}">
                </x-ui.input-search>
                <x-ui.form.button
                    class="main-search__filter-button"
                    only_icon="true"
                    color="dark"
                    x-on:click="filters_hide = !filters_hide">
                    <x-slot:icon class="button__icon-wrapper_cancel">
                        <x-svg.filter class="main-search__filter-icon button__icon"></x-svg.filter>
                    </x-slot:icon>
                </x-ui.form.button>
            </div>
            <div class="main-search__filters" x-cloak x-show="filters_hide" x-transition.scale.right>
                <x-grid type="container">

                    <x-grid.col xl="3" lg="4"  md="6" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="choices-select-auto"
                                id="select-test"
                                name="select-test"
                                label="Платформа">
                                <x-ui.form.option value="1">Playstation 3</x-ui.form.option>
                                <x-ui.form.option value="1">Xbox 360</x-ui.form.option>
                                <x-ui.form.option value="2">NES</x-ui.form.option>
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="3" lg="4"  md="6" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="choices-select-auto"
                                id="select-test"
                                name="select-test"
                                label="Тип издания">
                                <x-ui.form.option value="1">Classic</x-ui.form.option>
                                <x-ui.form.option value="1">Essentials</x-ui.form.option>
                                <x-ui.form.option value="2">Platinum</x-ui.form.option>
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="3" lg="4"  md="6" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="choices-select-auto"
                                id="select-test"
                                name="select-test"
                                label="Разработчик">
                                <x-ui.form.option value="1">Capcom</x-ui.form.option>
                                <x-ui.form.option value="1">Rockstar</x-ui.form.option>
                                <x-ui.form.option value="2">Insomniac</x-ui.form.option>
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="3" lg="4"  md="6" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="choices-select-auto"
                                id="select-test"
                                name="select-test"
                                label="Издатель">
                                <x-ui.form.option value="1">Capcom</x-ui.form.option>
                                <x-ui.form.option value="1">Rockstar</x-ui.form.option>
                                <x-ui.form.option value="2">Insomniac</x-ui.form.option>
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="3" lg="4"  md="6" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="choices-select-auto"
                                id="select-test"
                                name="select-test"
                                label="Жанр">
                                <x-ui.form.option value="1">Платформер</x-ui.form.option>
                                <x-ui.form.option value="1">FPS</x-ui.form.option>
                                <x-ui.form.option value="2">Головоломка</x-ui.form.option>
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="3" lg="4"  md="6" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="choices-select-auto"
                                id="select-test"
                                name="select-test"
                                label="Язык">
                                <x-ui.form.option value="1">Английский</x-ui.form.option>
                                <x-ui.form.option value="1">Русский</x-ui.form.option>
                                <x-ui.form.option value="2">Японский</x-ui.form.option>
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="3" lg="4"  md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :errors="$errors"
                                placeholder="Год выхода"
                                id="text"
                                name="text"
                                value="{{ old('text') }}"
                                type="number"
                                min="1950"
                                max="2100"
                                required
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="12" lg="12"  md="12" sm="12">
                        <x-ui.form.group>
                            <div class="main-search__footer">
                                <x-ui.form.button>{{ __('Отфильтровать') }}</x-ui.form.button>
                            </div>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
            </div>
        </div>
    </div>
</div>

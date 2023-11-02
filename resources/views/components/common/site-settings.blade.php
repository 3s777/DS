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

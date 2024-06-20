<div
    {{ $attributes->class([
            'site-settings'
        ])
    }}>
    <div class="site-settings__inner" x-data="{ siteSettingsHidden: true }">
        <div class="site-settings__button" x-on:click.stop="siteSettingsHidden = ! siteSettingsHidden" title="{{ __('Settings') }}">
            <x-svg.settings class="site-settings__icon"></x-svg.settings>
        </div>

        <x-ui.popover
            x-on:click.outside="siteSettingsHidden = true" ::class="siteSettingsHidden ? '' : 'site-settings__popover_visible'"
            class="site-settings__popover"
            title="{{ __('Choose language') }}"
            tail="right">

            <x-common.language-switcher class="site-settings__flags" />

            <div class="popover__title">
                {{ __('Choose theme color') }}
            </div>

            <nav class="site-settings__colors">
                <a class="site-settings__color" href="{{ route('set.theme', 2) }}"></a>
                <a class="site-settings__color site-settings__color_1" href="{{ route('set.theme', 3) }}"></a>
                <a class="site-settings__color site-settings__color_2" href="{{ route('set.theme', 4) }}"></a>
                <a class="site-settings__color site-settings__color_3" href="{{ route('set.theme', 5) }}"></a>
            </nav>

            <x-slot:close x-on:click="siteSettingsHidden = true">
                <x-svg.close class="popover__close-icon"></x-svg.close>
            </x-slot:close>
        </x-ui.popover>
    </div>
</div>

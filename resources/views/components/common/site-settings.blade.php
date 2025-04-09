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
            title="{{ __('common.choose_language') }}"
            tail="right">

            <x-common.language-switcher class="site-settings__flags" />

            <div class="popover__title">
                {{ __('common.choose_theme_color') }}
            </div>

            <x-common.theme-switcher class="site-settings__colors" link-class="site-settings" />

            <x-slot:close x-on:click="siteSettingsHidden = true">
                <x-svg.close class="popover__close-icon"></x-svg.close>
            </x-slot:close>
        </x-ui.popover>
    </div>
</div>

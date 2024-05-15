@props([
    'search' => true
])

<header class="header">
    <div class="container">
        <div class="header__inner">
            <x-common.logo
                class="header__logo"
                class-site-icon="header__site-icon"
                class-site-name="header__site-name" />

            <x-common.main-menu class="header__main-menu" />

            <x-ui.input-search wrapper-class="header__search" placeholder="Test" class="header__search-form"></x-ui.input-search>

            <div class="profile-menu">
                <div class="profile-menu__inner">
                    <x-common.auth-menu class="header__auth-menu" />
                    <x-common.chat-icon-notification class="header__chat-icon" count="5" />
                    <x-common.site-settings class="header__site-settings" />
                </div>
            </div>
        </div>
    </div>
</header>

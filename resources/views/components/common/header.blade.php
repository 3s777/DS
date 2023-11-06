@props([
    'search' => true
])

<header class="header">
    <div class="container">
        <div class="header__inner">
            <x-common.logo
                class="header__logo"
                class_site_icon="header__site-icon"
                class_site_name="header__site-name" />

            <x-common.main-menu />

            <div class="profile-menu">
                <div class="profile-menu__inner">
                    <x-common.auth-menu />
                    <x-common.site-settings />
                </div>
            </div>
        </div>
    </div>
</header>

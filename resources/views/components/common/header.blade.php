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

            <x-common.main-menu />

            <div class="profile-menu">
                <div class="profile-menu__inner">
                    <x-common.auth-menu />

                </div>
            </div>
        </div>
    </div>
</header>

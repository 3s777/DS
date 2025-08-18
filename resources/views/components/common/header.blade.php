@props([
    'search' => false,
    'mainFilters' => false
])

<header class="header" x-data>
    <div class="container">
        <div class="header__inner">
            <x-common.logo
                class="header__logo"
                class-site-icon="header__site-icon"
                class-site-name="header__site-name" />

            <x-common.main-menu class="header__main-menu" />

            <div class="profile-menu header__profile-menu">
                <div class="profile-menu__inner">
                    @if(request()->routeIs('admin.*'))
                        <x-admin.auth-menu class="header__auth-menu" />
                    @else
                        <x-common.auth-menu class="header__auth-menu" />
                    @endif
                    <x-common.chat-icon-notification class="header__chat-icon" count="5" />
                    <x-common.site-settings class="header__site-settings" />
                </div>
            </div>

            @if($search)
                <div class="header__search">
                    {{ $search }}
                </div>
            @endif
        </div>
    </div>
</header>

@if($mainFilters)
    {{ $mainFilters }}
@endif

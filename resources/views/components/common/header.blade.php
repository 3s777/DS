@aware([
    'search' => true,
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
                <x-common.main-search class="header__search" />
            @endif
        </div>
    </div>
</header>

@if($search)
    {{ $slot }}
@endif

@if($search)
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('filtersSearchValue', '{{ request('filters.search') }}');
                Alpine.store('mainFilters', {
                    hide: true,
                });
            })
        </script>
    @endpush
@endif

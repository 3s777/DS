@aware([
    'search' => false,
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

{{--            @if($search)--}}
{{--                <x-common.main-search class="header__search" />--}}
{{--            @endif--}}
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
                Alpine.store('mainFilters', {
                        hide: true,
                        value: '{{ request('filters.search') }}',
                        defaultAction: '{{ request()->url() }}',
                        selectedMediaType: '',
                        getFiltersAction() {
                            console.log(`${this.defaultAction}/${this.selectedMediaType.value}`);
                            return this.selectedMediaType
                                ? this.selectedMediaType.value
                                : this.defaultAction;
                        }
                    }
                );
                Alpine.store('filtersSearchValue', '{{ request('filters.search') }}');
                // Alpine.store('filtersMediaType', {
                //     currentAction: '',
                //     setAction(action) {
                //         this.currentAction = action;
                //     }
                // });
                // Alpine.store('mainFilters', {
                //     hide: true,
                // });
            })
        </script>
    @endpush
@endif

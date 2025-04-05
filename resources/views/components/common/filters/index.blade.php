@props([
    'searchPlaceholder' => __('filters.search'),
    'filterForm' => true
])

<div class="filters" x-data="{ filters_hide: true, search: '{{ request('filters.search') }}' }">
    <div class="filters__header">
        <x-ui.input-search
            x-model="search"
            class="filters__search-form"
            wrapper-class="filters__search"
            action="{{ request()->url() }}"
            method="get"
            :placeholder="$searchPlaceholder"
            color="dark"
            sortable="true"
        />

        @if($filterForm)
            <x-ui.form.button
                class="filters__trigger"
                only-icon="true"
                size="small"
                color="dark"
                ::class="filters_hide ? '' : 'button_submit'"
                x-on:click="filters_hide = !filters_hide">
                <x-slot:icon class="button__icon-wrapper_filter">
                    <x-svg.filter class="button__icon button__icon_small"></x-svg.filter>
                </x-slot:icon>
            </x-ui.form.button>
        @endif
    </div>

    @if($filterForm)
        <div class="filters__content filters" x-cloak x-show="!filters_hide" x-transition.scale.right>
            {{ $slot }}
        </div>
    @endif

    @if(request('filters'))
        <div class="filters__badges">
            <div class="current-filters">
                @foreach(filters() as $filter)
                    @if($loop->first)
                        <div class="current-filters__title">{{ __('filters.badges_title') }}: </div>
                    @endif

                    @if($filter->preparedValues())
                        {!! $filter->badgeView() !!}
                    @endif

                    @if($loop->last)
                        <x-ui.badge
                            class="current-filters__badge"
                            type="tag"
                            color="danger">
                            <a href="{{ request()->url() }}">
                                {{ __('filters.reset_all') }}
                            </a>
                        </x-ui.badge>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>

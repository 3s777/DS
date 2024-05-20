@props([
    'searchPlaceholder' => __('filters.search')
])

<div class="crud-filters" x-data="{ filters_hide: true, search: '{{ request('filters.search') }}' }">
    <div class="crud-filters__header">
        <x-ui.input-search
            x-model="search"
            class="crud-search__form"
            wrapper-class="crud-search"
            action="{{ request()->url() }}"
            method="get"
            placeholder="{{ $searchPlaceholder }}"
            color="dark"
            sortable="true"
        />

        <x-ui.form.button
            class="crud-filters__trigger"
            only-icon="true"
            size="small"
            color="dark"
            ::class="filters_hide ? '' : 'button_submit'"
            x-on:click="filters_hide = !filters_hide">
            <x-slot:icon class="button__icon-wrapper_filter">
                <x-svg.filter class="button__icon button__icon_small"></x-svg.filter>
            </x-slot:icon>
        </x-ui.form.button>
    </div>

    <div class="crud-filters__content filters" x-cloak x-show="!filters_hide" x-transition.scale.right>
        {{$slot}}
    </div>

    @if(request('filters'))
        <div class="crud-filters__badges">
            <div class="current-filters">

                @foreach(filters() as $filter)
                    @if($filter->preparedValues())
                        @if($loop->first)
                            <div class="current-filters__title">{{ __('filters.badges_title') }}: </div>
                        @endif

                        {!! $filter->badgeView() !!}

                        @dump($loop)

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
                    @endif
                @endforeach
            </div>
        </div>
    @endif
</div>

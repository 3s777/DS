@aware([
    'searchPlaceholder' => __('common.default_search_placeholder'),
    'hideFilters' => false
])

<div
    {{ $attributes->class([
            'main-search',
            'main-search_no-filters' => $hideFilters
            ])
    }}>

        <div class="main-search__header">
            <x-ui.input-search
                x-model="$store.filtersSearchValue"
                class="main-search__input"
                method="GET"
                wrapper-class="main-search__input-search"
                link="{{ route('search') }}"
                :placeholder="$searchPlaceholder">
            </x-ui.input-search>
            <x-ui.select.data
                name="manufacturer"
                select-name="game_platform_manufacturer_id"
                required
                :options="['n' => 'По носителю', 'v' => 'По вариации']"
                :default-option="trans_choice('game.platform_manufacturer.manufacturers', 1)"
                :label="trans_choice('game.platform_manufacturer.choose', 1)" />


            @if(!$hideFilters)
                <x-ui.form.button
                    class="main-search__filter-button"
                    only-icon="true"
                    color="dark"
                    ::class="$store.mainFilters.hide ? '' : 'button_submit'"
                    x-on:click="$store.mainFilters.hide = !$store.mainFilters.hide;">
                    <x-slot:icon class="button__icon-wrapper_cancel">
                        <x-svg.filter class="main-search__filter-icon button__icon"></x-svg.filter>
                    </x-slot:icon>
                </x-ui.form.button>
            @endif
        </div>

</div>

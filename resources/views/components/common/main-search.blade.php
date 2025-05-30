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
{{--                <x-ui.select.data--}}
{{--                    name="manufacturer"--}}
{{--                    select-name="game_platform_manufacturer_id"--}}
{{--                    :options="['n' => 'По носителю', 'v' => 'По вариации']"--}}
{{--                    :placeholder="false" />--}}

                <x-libraries.choices
                    class="media-type"
                    id="media-type"
                    name="filters[media-type-search]"
                    error="media-type">

                    <x-ui.form.option
                        value="1">
                        По носителю
                    </x-ui.form.option>
                    <x-ui.form.option
                        value="2">
                        По вариации
                    </x-ui.form.option>
                </x-libraries.choices>


                    @push('scripts')
                        <script type="module">
                            const mediaType = document.querySelector('.media-type');
                            new Choices(mediaType, {
                                itemSelectText: '',
                                removeItems: false,
                                removeItemButton: false,
                                searchEnabled: false,
                            });
                        </script>
                    @endpush



            </x-ui.input-search>



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

@props([
    'searchPlaceholder' => __('common.default_search_placeholder'),
    'hideFilters' => false,
    'mediaRoute' => false,
    'variationRoute' => false
])

<div
    {{ $attributes->class([
            'main-search',
            'main-search_no-filters' => $hideFilters
            ])
    }}>

        <div class="main-search__header">
            <x-ui.input-search
                x-model="$store.mainFilters.searchInput"
                class="main-search__input"
                method="GET"
                wrapper-class="main-search__input-search"
                link="{{ route('search') }}"
                :placeholder="$searchPlaceholder">

                <div class="main-search__type">
                    <x-libraries.choices
                        x-model="$store.mainFilters.selectedMediaType"
                        {{--                    @change="$store.mainFilters.getFiltersAction()"--}}
                        class="media-type"
                        id="media-type"
                        name="filters[media-type-search]"
                        error="media-type">
                        <x-ui.form.option
                            value="{{ $mediaRoute }}">
                            {{ __('filters.by_medias') }}
                        </x-ui.form.option>
                        <x-ui.form.option
                            value="{{ $variationRoute }}">
                            {{ __('filters.by_variations') }}
                        </x-ui.form.option>
                    </x-libraries.choices>
                </div>
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

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('mainFilters', {
                    hide: true,
                    searchInput: '{{ request('filters.search') }}',
                    defaultAction: '{{ request()->url() }}',
                    selectedMediaType: '{{ url()->current() }}',
                    getFiltersAction() {
                        return this.selectedMediaType
                            ? this.selectedMediaType.value
                            : this.defaultAction;
                    }
                }
            );

            {{--Alpine.store('filtersSearchValue', '{{ request('filters.search') }}');--}}
        })
    </script>
@endpush

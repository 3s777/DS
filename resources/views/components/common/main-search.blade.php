@props([
    'searchPlaceholder' => __('common.default_search_placeholder'),
    'hideFilters' => false,
    'mediaType' => true,
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
                x-bind:action="$store.mainFilters.getFiltersAction()"
                wrapper-class="main-search__input-search"
                link="{{ route('search') }}"
                :placeholder="$searchPlaceholder">

                @if($mediaType)
                    <div class="main-search__type">
                        <x-libraries.choices
                            x-model="$store.mainFilters.selectedMediaType"
                            {{--                    @change="$store.mainFilters.getFiltersAction()"--}}
                            class="main-search__media-type"
                            id="main-search__media-type"
                            name="filters[media-type-search]"
                            error="main-search__media-type">
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
                @endif
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
    @if($mediaType)
        <script type="module">
            const mediaType = document.querySelector('.main-search__media-type');
            new Choices(mediaType, {
                itemSelectText: '',
                removeItems: false,
                removeItemButton: false,
                searchEnabled: false,
            });
        </script>
    @endif

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('mainFilters', {
                    hide: true,
                    isVariation: false,
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
        })
    </script>
@endpush

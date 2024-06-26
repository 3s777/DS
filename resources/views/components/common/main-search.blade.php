<div
    {{ $attributes->class([
            'main-search'
            ])
    }}>
    <div class="main-search">
        <div class="main-search__header">
            <x-ui.input-search
                class="main-search__input"
                wrapper-class="main-search__input-search"
                link="{{ route('search') }}"
                placeholder="{{ __('common.default_search_placeholder') }}">
            </x-ui.input-search>
            <x-ui.form.button
                class="main-search__filter-button"
                only-icon="true"
                color="dark"
                ::class="$store.mainFilters.hide ? '' : 'button_submit'"
                x-on:click="$store.mainFilters.hide = !$store.mainFilters.hide; console.log($store.mainFilters.hide)">
                <x-slot:icon class="button__icon-wrapper_cancel">
                    <x-svg.filter class="main-search__filter-icon button__icon"></x-svg.filter>
                </x-slot:icon>
            </x-ui.form.button>
        </div>
    </div>
</div>

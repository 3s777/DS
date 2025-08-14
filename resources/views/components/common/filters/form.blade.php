@props([
    'buttons',
    'action' => request()->url()
])

<x-ui.form action="{{ $action }}" {{ $attributes }} :get="true">
    @if(request('sort'))
        <input name="sort" type="hidden" value="{{ request('sort') }}">
        <input name="order" type="hidden" value="{{ request('order') }}">
    @endif
    <x-common.filters.hidden-search bind-value="$store.filtersSearchValue" />
    <x-grid type="container">

    {{ $slot }}

    @if($buttons->isEmpty())
        <x-grid.col xl="12" lg="12" md="12" sm="12">
            <div class="filters__buttons">
                <x-ui.form.button x-bind:disabled="preventSubmit">{{ __('common.filter') }}</x-ui.form.button>
                <x-ui.form.button tag="a" :link="request()->url()" color="warning">{{ __('common.reset') }}</x-ui.form.button>
                <x-ui.form.button color="cancel"  x-on:click.prevent="$store.mainFilters.hide = true">{{ __('common.close') }}</x-ui.form.button>
            </div>
        </x-grid.col>
    @else
        {{ $buttons }}
    @endif
    </x-grid>
</x-ui.form>

@props([

])

<form action="{{ request()->url() }}" method="get">
    @if(request('sort'))
        <input name="sort" type="hidden" value="{{ request('sort') }}">
        <input name="order" type="hidden" value="{{ request('order') }}">
    @endif
    <x-common.filters.hidden-search />
    <x-grid type="container">

    {{ $slot }}

    <x-slot:buttons>
        <x-grid.col xl="12" lg="12"  md="12" sm="12">
            <x-ui.form.group>
                <div class="crud-filters__buttons">
                    <x-ui.form.button>{{ __('common.filter') }}</x-ui.form.button>
                    <x-ui.form.button tag="a" link="{{ request()->url() }}" color="warning">{{ __('common.reset') }}</x-ui.form.button>
                    <x-ui.form.button color="cancel"  x-on:click.prevent="filters_hide = true">{{ __('common.close') }}</x-ui.form.button>
                </div>
            </x-ui.form.group>
        </x-grid.col>
    </x-slot>
    </x-grid>
</form>

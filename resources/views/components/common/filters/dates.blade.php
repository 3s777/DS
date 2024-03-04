<x-grid.col xl="3" lg="4"  md="6" sm="12">
    <x-ui.form.group>
        <x-ui.form.datepicker
            placeholder="{{ __('filters.start-date') }}"
            id="start_date"
            name="filters[dates][from]"
            value="{{ request('filters.dates.from') }}">
        </x-ui.form.datepicker>
    </x-ui.form.group>
</x-grid.col>
<x-grid.col xl="3" lg="4"  md="6" sm="12">
    <x-ui.form.group>
        <x-ui.form.datepicker
            placeholder="{{ __('filters.finish-date') }}"
            id="finish_date"
            name="filters[dates][to]"
            value="{{ request('filters.dates.to') }}">
        </x-ui.form.datepicker>
    </x-ui.form.group>
</x-grid.col>

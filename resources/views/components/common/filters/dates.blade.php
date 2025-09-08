<x-ui.form.datepicker {{ $attributes->class([
            'filters__'.$name
        ])
    }}
    placeholder="{{ $filter->placeholder($direction) }}"
    id="filters_{{ $name }}_{{ $direction }}"
    name="filters[{{ $name }}][{{ $direction }}]"
    value="{{ request('filters.'.$name.'.'.$direction) }}">
</x-ui.form.datepicker>

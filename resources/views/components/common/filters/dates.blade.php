@props([
    'name' => 'dates',
    'direction' => 'from'
])

<x-ui.form.datepicker {{ $attributes->class([
            'filters__'.$name
        ])
    }}
    placeholder="{{ __('filters.'.$name.'_'.$direction) }}"
    id="filters_{{ $name }}_{{ $direction }}"
    name="filters[{{ $name }}][{{ $direction }}]"
    value="{{ request('filters.'.$name.'.'.$direction) }}">
</x-ui.form.datepicker>


@props([
    'name',
    'options',
    'placeholder',
    'selectName' => 'filters['.$name.']',
    'filter' => $filter ?? get_filter($name)
])

<x-ui.select.data
    :selected="request('filters.'.$name)"
    :show-old="false"
    :name="$name"
    :options="$options ?? $filter->getPreparedOptions()"
    selectName="{{ $selectName }}"
    :label="$placeholder ?? $filter->placeholder()"
    defaultOption="{{ $filter->title() }}">
</x-ui.select.data>

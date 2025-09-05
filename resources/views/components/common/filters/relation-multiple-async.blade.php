@props([
    'name',
    'route',
    'placeholder',
    'selectName' => 'filters['.$name.'][]',
    'filter' => $filter ?? get_filter($name)
])

<x-ui.select.async-multiple
    :selected="$filter->preparedSelected()"
    :show-old="false"
    :name="$name"
    select-name="{{ $selectName }}"
    :label="$placeholder ?? $filter->placeholder()"
    defaultOption="{{ $filter->title() }}"
    :route="$route">
</x-ui.select.async-multiple>

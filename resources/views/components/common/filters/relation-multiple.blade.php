@props([
    'name',
    'options',
    'placeholder',
    'selectName' => 'filters['.$name.'][]',
    'filter' => $filter ?? get_filter($name)
])

<x-ui.select.data-multiple
    :name="$name"
    select-name="{{ $selectName }}"
    :options="$options ?? $filter->getPreparedOptions()"
    :label="$placeholder ?? $filter->placeholder()"
    default-option="{{ $filter->title() }}"
    :selected="$filter->preparedSelected()"
/>

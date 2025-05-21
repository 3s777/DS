@props([
    'name',
    'options',
    'placeholder',
    'selectName' => 'filters['.$name.'][]'
])

<x-ui.select.data-multiple
    :name="$name"
    select-name="{{ $selectName }}"
    :options="$options ?? get_filter($name)->getPreparedOptions()"
    :label="$placeholder ?? get_filter($name)->placeholder()"
    default-option="{{ get_filter($name)->title() }}"
    :selected="get_filter($name)->preparedSelected()"
/>

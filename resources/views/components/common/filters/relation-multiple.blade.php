@props([
    'name',
    'options' => get_filter($name)->getPreparedOptions(),
    'placeholder' => get_filter($name)->placeholder()
])

<x-ui.select.data-multiple
    :name="$name"
    select-name="filters[{{ $name }}][]"
    :options="$options"
    :label="$placeholder"
    default-option="{{ get_filter($name)->title() }}"
    :selected="get_filter($name)->preparedSelected()"
/>

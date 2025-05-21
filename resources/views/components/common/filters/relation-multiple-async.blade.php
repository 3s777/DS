@props([
    'name',
    'route',
    'placeholder',
    'selectName' => 'filters['.$name.'][]'
])

<x-ui.select.async-multiple
    :selected="get_filter($name)->preparedSelected()"
    :show-old="false"
    :name="$name"
    select-name="{{ $selectName }}"
    :label="$placeholder ?? get_filter($name)->placeholder()"
    defaultOption="{{ get_filter($name)->title() }}"
    :route="$route">
</x-ui.select.async-multiple>

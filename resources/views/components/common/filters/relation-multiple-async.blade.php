@props([
    'name',
    'route',
    'placeholder' => get_filter($name)->placeholder()
])

<x-ui.async-select-multiple
    :selected="get_filter($name)->relatedModels ?? false"
    :show-old="false"
    :name="$name"
    array-key="filters"
    :label="$placeholder"
    defaultOption="{{ get_filter($name)->title() }}"
    :route="$route">
</x-ui.async-select-multiple>

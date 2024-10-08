@props([
    'name',
    'route',
    'placeholder' => get_filter($name)->placeholder()
])

<x-ui.select.async-multiple
    :selected="get_filter($name)->relatedModels"
    :show-old="false"
    :name="$name"
    select-name="{{ $name.'[filters]' }}"
    :label="$placeholder"
    defaultOption="{{ get_filter($name)->title() }}"
    :route="$route">
</x-ui.select.async-multiple>

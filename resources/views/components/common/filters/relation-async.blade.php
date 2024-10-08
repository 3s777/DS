@props([
    'name',
    'route',
    'placeholder' => get_filter($name)->placeholder()
])

<x-ui.select.async
    :selected="get_filter('user')->relatedModel"
    :show-old="false"
    :name="$name"
    :select-name="$name"
    :label="$placeholder"
    defaultOption="{{ get_filter($name)->title() }}"
    selectName="filters[{{ $name }}]"
    :route="$route" />

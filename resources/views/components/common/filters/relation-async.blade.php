@props([
    'name',
    'route',
    'placeholder' => get_filter($name)->placeholder()
])

<x-ui.async-select
    :selected="get_filter('user')->relatedModel ?? false"
    :show-old="false"
    :name="$name"
    :label="$placeholder"
    defaultOption="{{ get_filter($name)->title() }}"
    selectName="filters[{{ $name }}]"
    :route="$route" />

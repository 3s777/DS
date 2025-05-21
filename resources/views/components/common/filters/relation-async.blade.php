@props([
    'name',
    'route',
    'placeholder',
    'selectName' => 'filters['.$name.']'
])

<x-ui.select.async
    :selected="get_filter($name)->relatedModel"
    :show-old="false"
    :name="$name"
    :select-name="$name"
    :label="$placeholder ?? get_filter($name)->placeholder()"
    defaultOption="{{ get_filter($name)->title() }}"
    selectName="{{ $selectName }}"
    :route="$route" />

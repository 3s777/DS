@props([
    'name',
    'route',
    'placeholder',
    'selectName' => 'filters['.$name.']',
    'filter' => $filter ?? get_filter($name)
])

<x-ui.select.async
    :selected="$filter->relatedModel"
    :show-old="false"
    :name="$name"
    :select-name="$name"
    :label="$placeholder ?? $filter->placeholder()"
    defaultOption="{{ $filter->title() }}"
    selectName="{{ $selectName }}"
    :route="$route" />

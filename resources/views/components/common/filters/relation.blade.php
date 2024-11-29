@props([
    'name',
    'options',
    'placeholder' => get_filter($name)->placeholder()
])

<x-ui.select.data
    :selected="request('filters.'.$name)"
    :show-old="false"
    :name="$name"
    :options="$options ?? get_filter($name)->getPreparedOptions()"
    select-name="{{ 'filters['.$name.']' }}"
    :label="$placeholder"
    defaultOption="{{ get_filter($name)->title() }}">
</x-ui.select.data>

@props([
    'name',
    'options',
    'placeholder',
    'selectName' => 'filters['.$name.']'
])

<x-ui.select.data
    :selected="request('filters.'.$name)"
    :show-old="false"
    :name="$name"
    :options="$options ?? get_filter($name)->getPreparedOptions()"
    selectName="{{ $selectName }}"
    :label="$placeholder ?? get_filter($name)->placeholder()"
    defaultOption="{{ get_filter($name)->title() }}">
</x-ui.select.data>

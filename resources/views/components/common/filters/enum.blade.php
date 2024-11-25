@props([
    'name',
    'options' => get_filter($name)->options(),
    'multiple' => false,
    'placeholder' => get_filter($name)->placeholder(),
    'valueMethod' => false,
])

<x-ui.select.enum
    :name="$name"
    :select-name="$multiple ? 'filters['.$name.'][]' : 'filters['.$name.']'"
    :selected="request('filters.'.$name)"
    :show-old="false"
    :multiple="$multiple"
    :valueMethod="$valueMethod"
    :options="$options"
    default-option="{{ get_filter($name)->title() }}"
    :label="$placeholder" />

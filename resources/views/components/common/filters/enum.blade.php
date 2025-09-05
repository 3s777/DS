@props([
    'name',
    'filter' => $filter ?? get_filter($name),
    'options' => $filter->options(),
    'multiple' => false,
    'placeholder' => $filter->placeholder(),
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
    default-option="{{ $filter->title() }}"
    :label="$placeholder" />

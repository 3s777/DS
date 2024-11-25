@props([
    'name',
    'placeholder' => get_filter($name)->placeholder()
])

<x-ui.form.input-text
    :placeholder="$placeholder"
    :id="$name"
    :value="request('filters.'.$name)"
    name='filters[{{ $name }}]'
    autocomplete="on">
</x-ui.form.input-text>

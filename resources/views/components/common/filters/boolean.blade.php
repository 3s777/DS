@props([
    'name',
    'label'
])

<x-ui.form.switcher
    name='filters[{{ $name }}]'
    :id="$name"
    value="1"
    :checked="request('filters.'.$name)"
    :label="$label">
</x-ui.form.switcher>


<x-ui.select.data
    :selected="request('filters.'.$name)"
    :show-old="false"
    :name="$name"
    :options="$options"
    selectName="{{ $selectName }}"
    :label="$placeholder"
    defaultOption="{{ $filter->title() }}">
</x-ui.select.data>

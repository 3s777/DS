<x-ui.select.async-multiple
    :selected="$filter->preparedSelected()"
    :show-old="false"
    :name="$name"
    select-name="{{ $selectName }}"
    :label="$placeholder"
    defaultOption="{{ $filter->title() }}"
    :route="$route">
</x-ui.select.async-multiple>

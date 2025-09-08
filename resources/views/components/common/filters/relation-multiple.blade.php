<x-ui.select.data-multiple
    :name="$name"
    select-name="{{ $selectName }}"
    :options="$options"
    :label="$placeholder"
    default-option="{{ $filter->title() }}"
    :selected="$filter->preparedSelected()"
/>

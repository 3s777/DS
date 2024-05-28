<x-ui.form.input-checkbox
    class="row-checkbox"
    id="selected_row_{{ $model->id }}"
    name="selected_row_{{ $model->id }}"
    size="small"
    x-data="{id:'{{ $model->id }}', name: '{{ addslashes($model->name) }}'}"
    @change="$store.selectedRows.select(id, name)"
/>

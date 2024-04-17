<x-ui.form.input-checkbox
    class="row-checkbox"
    x-data="{id:'{{ $model->id }}', name: '{{ $model->name }}'}"
    @change="$store.selectedRows.select(id, name)"
    id="selected_row_{{ $model->id }}"
    name="selected_row_{{ $model->id }}"
/>

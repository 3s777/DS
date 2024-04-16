<x-ui.form.input-checkbox
    class="row-checkbox"
    x-data="{id:'{{ $model->id }}', name: '{{ $model->name }}'}"
    @click="selectRow"
    id="selected_row_{{ $model->id }}"
    name="selected_row_{{ $model->id }}"
/>

<x-ui.form.input-checkbox
    class="action-table__select-all"
    name="action-table__select_all"
    id="action-table__select_all"
    size="small"
    label="{{ __('common.select_all') }}"
    x-data="{allIds:[{{ $ids }}], allNames: [{{ $names }}]}"
    x-bind:checked="selectall"
    @click="toggleAllCheckboxes(allIds, allNames)"
/>


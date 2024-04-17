<x-ui.form.input-checkbox
    name="selectAll"
    id="selectAll"
    x-data="{
                            allIds:[{{$ids}}],
                            allNames: [{{$names}}]
                        }"
    x-bind:checked="selectall"
    @click="toggleAllCheckboxes(allIds, allNames)"

/>

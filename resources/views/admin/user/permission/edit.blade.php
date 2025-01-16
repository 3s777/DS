<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('permissions.update', $permission->id)"
        :title="__('permission.edit')"
        :model="$permission">
                <x-grid type="container">
                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :placeholder="trans_choice('common.name', 1)"
                                id="name"
                                name="name"
                                :value="$permission->name"
                                required
                                autocomplete="on"
                                autofocus>
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :placeholder="__('common.display_name')"
                                id="display_name"
                                name="display_name"
                                :value="$permission->display_name"
                                required
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
    </x-admin.crud-form>
</x-layouts.admin>

<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('roles.store')"
        :title="__('role.add')">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.name', 1)"
                            id="name"
                            name="name"
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
                            required
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>

            <x-grid type="container">
                @foreach($permissions as $key => $permission)
                    <x-grid.col xl="3" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group size="small">
                            <x-ui.form.input-checkbox
                                id="permission-{{ $key }}"
                                name="permissions[]"
                                :value="$permission['name']"
                                :label="$permission['display_name']"
                                :checked="in_array($permission['name'], old('permissions', []))">
                            </x-ui.form.input-checkbox>
                        </x-ui.form.group>
                    </x-grid.col>
                @endforeach
            </x-grid>
    </x-admin.crud-form>
</x-layouts.admin>

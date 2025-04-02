<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.permissions.store')"
        :title="__('user.permission.add')">
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

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data
                            name="guard_name"
                            select-name="guard_name"
                            required
                            :options="[
                                'admin' => trans_choice('user.admins', 1),
                                'collector' => trans_choice('user.collectors', 1)
                            ]"
                            :default-option="__('user.type')"
                            :label="__('user.choose_type')" />
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
    </x-admin.crud-form>
</x-layouts.admin>

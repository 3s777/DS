<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.shelves.store')"
        :title="__('shelf.add')">
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
                            :placeholder="trans_choice('common.numbers', 1)"
                            id="number"
                            name="number"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="collector"
                            select-name="collector_id"
                            :error="$errors->has('collector_id')"
                            route="admin.select-collectors"
                            :default-option="trans_choice('user.collector.choose', 1)"
                            :label="trans_choice('user.collectors', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        <x-slot:sidebar></x-slot:sidebar>
    </x-admin.crud-form>
</x-layouts.admin>

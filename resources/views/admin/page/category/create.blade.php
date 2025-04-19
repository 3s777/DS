<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.page-categories.store')"
        :title="__('page.category.add')"
        >
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
                        :placeholder="__('common.slug')"
                        id="slug"
                        name="slug"
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.select.async
                        name="user"
                        select-name="user_id"
                        route="admin.select-users"
                        :default-option="trans_choice('user.choose', 1)"
                        :label="trans_choice('user.users', 1)">
                    </x-ui.select.async>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.select.data
                        name="parent_id"
                        select-name="parent_id"
                        :options="$categories"
                        :default-option="trans_choice('page.category.choose', 1)"
                        :label="trans_choice('page.category.parent', 1)">
                    </x-ui.select.data>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>
    </x-admin.crud-form>
</x-layouts.admin>

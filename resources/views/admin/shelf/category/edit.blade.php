<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.categories.update', $category->slug)"
        :title="__('collectible.category.edit')"
        :model="$category">
        <x-grid type="container">
            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :placeholder="trans_choice('common.name', 1)"
                        id="name"
                        name="name"
                        :value="$category->name"
                        required
                        autocomplete="on"
                        autofocus>
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.select.data
                        name="model"
                        select-name="model"
                        :selected="$category->model"
                        :options="$collectables"
                        :required="true"
                        :default-option="trans_choice('common.model', 1)"
                        :label="trans_choice('common.choose_model', 1)" />
                </x-ui.form.group>
            </x-grid.col>

            <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                <x-ui.form.group>
                    <x-ui.form.input-text
                        :placeholder="__('common.slug')"
                        id="slug"
                        name="slug"
                        :value="$category->slug"
                        autocomplete="on">
                    </x-ui.form.input-text>
                </x-ui.form.group>
            </x-grid.col>
        </x-grid>
    </x-admin.crud-form>
</x-layouts.admin>

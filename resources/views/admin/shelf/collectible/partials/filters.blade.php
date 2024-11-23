<x-admin.filters search-placeholder="{{ __('shelf.search') }}">
    <x-admin.filters-form>
        <x-grid.col xl="3" lg="4"  md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4"  md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates direction="to" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-async name="user" route="select-users" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.select.enum
                    name="condition"
                    select-name="filters[condition][]"
                    :selected="request('filters.condition')"
                    :multiple="true"
                    :options="$conditions"
                    :default-option="__('common.condition')"
                    :label="__('common.choose_condition')"
                    :placeholder="__('common.condition')" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.select.enum
                    name="collectable_type"
                    select-name="filters[collectable_type]"
                    value-method="morphName"
                    :selected="request('filters.collectable_type')"
                    :options="$types"
                    :default-option="trans_choice('collectible.type', 1)"
                    :label="__('collectible.choose_type')"
                    :placeholder="trans_choice('collectible.type', 1)" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-ui.select.enum
                    name="target"
                    select-name="filters[target]"
                    :selected="request('filters.target')"
                    :options="$targets"
                    :default-option="__('collectible.target')"
                    :label="__('collectible.choose_target')"
                    :placeholder="__('collectible.target')" />
            </x-ui.form.group>
        </x-grid.col>

        <x-slot:buttons></x-slot:buttons>
    </x-admin.filters-form>
</x-admin.filters>

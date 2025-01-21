<x-admin.filters search-placeholder="{{ __('collectible.search') }}">
    <x-admin.filters-form>
        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
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
                <x-common.filters.enum name="condition" :multiple="true" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation name="category" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.enum name="target" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates name="purchased_dates" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates name="purchased_dates" direction="to" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.search name="seller" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.search name="additional_field" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.range name="purchase_price" />
            </x-ui.form.group>
        </x-grid.col>

{{--        <x-grid.col xl="3" lg="4" md="6" sm="12">--}}
{{--            <x-ui.form.group>--}}
{{--                <x-common.filters.range name="sale_price" />--}}
{{--            </x-ui.form.group>--}}
{{--        </x-grid.col>--}}

        <x-slot:buttons></x-slot:buttons>
    </x-admin.filters-form>
</x-admin.filters>

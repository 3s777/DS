<x-admin.filters :search-placeholder="__('game_publisher.search')">
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
                <x-ui.select.async
                    :selected="get_filter('user')->relatedModel ?? false"
                    :show-old="false"
                    name="user"
                    select-name="user_id"
                    :label="trans_choice('user.users', 1)"
                    :default-option="trans_choice('user.choose', 1)"
                    selectName="filters[user]"
                    route="select-users"></x-ui.select.async>
            </x-ui.form.group>
        </x-grid.col>
        <x-slot:buttons></x-slot:buttons>
    </x-admin.filters-form>
</x-admin.filters>

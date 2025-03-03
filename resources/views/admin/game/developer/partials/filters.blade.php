<x-admin.filters :search-placeholder="__('game.developer.search')">
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
                    selectName="filters[user]"
                    route="admin.select-users"
                    :label="trans_choice('user.users', 1)"
                    :defaultOption="trans_choice('user.choose', 1)"></x-ui.select.async>
            </x-ui.form.group>
        </x-grid.col>

{{--        @foreach(filters() as $filter)--}}
{{--        {!! $filter !!}--}}
{{--        @endforeach--}}

        <x-slot:buttons></x-slot:buttons>
    </x-admin.filters-form>
</x-admin.filters>

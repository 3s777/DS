<x-admin.crud-filters search-placeholder="{{ __('game_developer.search') }}">
    <x-admin.crud-filters-form>
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
                <x-ui.async-select
                    :selected="get_filter('user')->relatedModel ?? false"
                    :show-old="false"
                    name="user"
                    label="{{ __('user.user') }}"
                    defaultOption="{{ __('user.choose') }}"
                    selectName="filters[user]"
                    route="select-users">я</x-ui.async-select>
            </x-ui.form.group>
        </x-grid.col>

{{--        @foreach(filters() as $filter)--}}
{{--        {!! $filter !!}--}}
{{--        @endforeach--}}

        <x-slot:buttons></x-slot:buttons>
    </x-admin.crud-filters-form>
</x-admin.crud-filters>

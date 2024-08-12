<x-admin.crud-filters search-placeholder="{{ __('game.search') }}">
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

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple name="genres" :list="$genres" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple name="platforms" :list="$platforms" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple-async name="developers" route="select-game-developers" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple-async name="publishers" route="select-game-publishers" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-async name="user" route="select-users" />
            </x-ui.form.group>
        </x-grid.col>

{{--        @foreach(filters() as $filter)--}}
{{--        {!! $filter !!}--}}
{{--        @endforeach--}}

        <x-slot:buttons></x-slot:buttons>
    </x-admin.crud-filters-form>
</x-admin.crud-filters>

{{--<x-common.filters.form x-bind:action="$store.mainFilters.getFiltersAction()">--}}
<x-common.filters.form>
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
                <x-common.filters.relation-multiple name="genres" select-name="filters[genres][]"/>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple name="platforms" select-name="filters[platforms][]"/>
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple-async name="developers" select-name="filters[developers][]" route="select-game-developers" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple-async name="publishers" select-name="filters[publishers][]" route="select-game-publishers" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="6" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.relation-multiple-async name="games" select-name="filters[games][]" route="select-games" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates name="released_at" />
            </x-ui.form.group>
        </x-grid.col>

        <x-grid.col xl="3" lg="4" md="6" sm="12">
            <x-ui.form.group>
                <x-common.filters.dates name="released_at" direction="to" />
            </x-ui.form.group>
        </x-grid.col>

        <x-slot:buttons></x-slot:buttons>
    </x-common.filters.form>

<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('games.store')"
        :title="__('game.add')"
        :images="true">
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
                        <x-ui.form.datepicker
                            :placeholder="__('game.released_at')"
                            id="released_at"
                            name="released_at">
                        </x-ui.form.datepicker>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.input
                            name="alternative_names"
                            :placeholder="__('common.alternative_names')"
                            :default-option="trans_choice('common.name', 2)" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="genres"
                            select-name="genres[]"
                            :options="$genres"
                            :label="trans_choice('game_genre.choose', 2)"
                            :default-option="trans_choice('game_genre.genres', 2)" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="platforms"
                            select-name="platforms[]"
                            :options="$platforms"
                            :label="trans_choice('game_platform.choose', 2)"
                            :default-option="trans_choice('game_platform.platforms', 2)" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-multiple
                            name="developers"
                            select-name="developers[]"
                            route="select-game-developers"
                            :default-option="trans_choice('game_developer.developers', 1)"
                            :label="trans_choice('game_developer.choose', 2)">
                        </x-ui.select.async-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-multiple
                            name="publishers"
                            select-name="publishers[]"
                            route="select-game-publishers"
                            :default-option="trans_choice('game_publisher.publishers', 2)"
                            :label="trans_choice('game_publisher.choose', 2)">
                        </x-ui.select.async-multiple>
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
            </x-grid>
        <x-slot:sidebar></x-slot:sidebar>
    </x-admin.crud-form>
</x-layouts.admin>

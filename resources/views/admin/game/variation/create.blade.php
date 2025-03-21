<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.game-media-variations.store')"
        :title="__('game.media.add')"
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
                            :placeholder="trans_choice('common.article_numbers', 1)"
                            id="article_number"
                            name="article_number"
                            autocomplete="on">
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

                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.input
                            name="alternative_names"
                            :placeholder="__('common.alternative_names')"
                            :default-option="trans_choice('common.name', 2)"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.input
                            name="barcodes"
                            :placeholder="trans_choice('common.enter_barcodes', 2)"
                            :default-option="trans_choice('common.barcodes', 1)"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="game_media_id"
                            select-name="game_media_id"
                            :error="$errors->has('game_media_id')"
                            route="game-media.select"
                            :default-option="trans_choice('game.media.medias', 1)"
                            :label="trans_choice('game.media.choose', 2)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="kit_items"
                            select-name="kit_items[]"
                            :options="$kitItems"
                            :label="trans_choice('collectible.kit.choose', 2)"
                            :default-option="trans_choice('collectible.kit.items', 2)"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            name="user"
                            select-name="user_id"
                            :error="$errors->has('user_id')"
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

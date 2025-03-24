<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('admin.game-medias.update', $gameMedia->slug)"
        :title="__('game.media.edit')"
        :model="$gameMedia"
        :images="true">
            <x-grid type="container">
                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.name', 1)"
                            id="name"
                            name="name"
                            :value="$gameMedia->name"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-multiple
                            name="games"
                            select-name="games[]"
                            route="select-games"
                            :selected="$selectedGames"
                            :default-option="trans_choice('game.games', 1)"
                            :label="trans_choice('game.choose', 1)">
                        </x-ui.select.async-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="genres"
                            select-name="genres[]"
                            :options="$genres"
                            :label="trans_choice('game.genre.choose', 2)"
                            :selected="$selectedGenres" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="platforms"
                            select-name="platforms[]"
                            :options="$platforms"
                            :label="trans_choice('game.platform.choose', 2)"
                            :selected="$selectedPlatforms" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-multiple
                            name="developers"
                            select-name="developers[]"
                            route="select-game-developers"
                            :selected="$selectedDevelopers"
                            :default-option="trans_choice('game.developer.developers', 1)"
                            :label="trans_choice('game.developer.choose', 2)">
                        </x-ui.select.async-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-multiple
                            name="publishers"
                            select-name="publishers[]"
                            route="select-game-publishers"
                            :selected="$selectedPublishers"
                            :default-option="trans_choice('game.publisher.publishers', 2)"
                            :label="trans_choice('game.publisher.choose', 2)">
                        </x-ui.select.async-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.datepicker
                            :placeholder="__('game.media.released_at')"
                            id="released_at"
                            name="released_at"
                            :value="$gameMedia->released_at">
                        </x-ui.form.datepicker>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('common.slug')"
                            id="slug"
                            name="slug"
                            :value="$gameMedia->slug"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async
                            :selected="$selectedUser"
                            name="user"
                            select-name="user_id"
                            route="admin.select-users"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>

            <x-grid type="container">
                <x-grid.col xl="12">
                    <x-ui.title indent="small">{{ __('collectible.variation.available') }}</x-ui.title>
                </x-grid.col>

                    @foreach($gameMedia->variations as $variation)
                        <x-grid.col xl="6" ls="6" ml="12">
                            <x-common.action-horizontal-preview
                                :model="$variation"
                                route-prefix="admin.game-media-variations">
                                <x-slot:image>
                                    <a href="{{ asset('/storage/images/'.$variation->getFeaturedImagePathWebp()) }}" data-fancybox="">
                                        <x-ui.responsive-image
                                            :model="$variation"
                                            :image-sizes="['extra_small','small','medium']"
                                            :path="$variation->getFeaturedImagePath()"
                                            :placeholder="false"
                                            sizes="100px">
                                            <x-slot:img alt="" title=""></x-slot:img>
                                        </x-ui.responsive-image>
                                    </a>
                                </x-slot:image>
                                <div>{{ $variation->article_number }}</div>
                                @if($variation->is_main)
                                    <x-ui.tag  color="success" size="small">
                                        {{ trans_choice('common.main', 1) }}
                                    </x-ui.tag>
                                @endif
                            </x-common.action-horizontal-preview>
                        </x-grid.col>
                    @endforeach

            </x-grid>

            <x-grid type="container">
                <x-grid.col xl="12">
                    <x-ui.title>Возможно в будущем удалить</x-ui.title>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="trans_choice('common.article_numbers', 1)"
                            id="article_number"
                            name="article_number"
                            :value="$gameMedia->article_number"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.input
                            name="alternative_names"
                            :placeholder="__('common.alternative_names')"
                            :value="implode('||', $gameMedia->alternative_names)"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.input
                            name="barcodes"
                            :placeholder="trans_choice('common.enter_barcodes', 2)"
                            :value="implode('||', $gameMedia->barcodes)"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="kit_items"
                            select-name="kit_items[]"
                            :selected="$selectedKitItems"
                            :options="$kitItems"
                            :label="trans_choice('collectible.kit.choose', 2)"
                            :default-option="trans_choice('collectible.kit.items', 2)"
                        />
                    </x-ui.form.group>
                </x-grid.col>

            </x-grid>
        <x-slot:sidebar></x-slot:sidebar>
    </x-admin.crud-form>

</x-layouts.admin>



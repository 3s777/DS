<x-layouts.admin :search="false">
    <x-admin.crud-form
        :action="route('game-medias.store')"
        :title="__('game_media.add')"
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
                        <x-ui.form.datepicker
                            :placeholder="__('game_media.released_at')"
                            id="released_at"
                            name="released_at">
                        </x-ui.form.datepicker>
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
                        <x-ui.select.async-multiple
                            name="games"
                            select-name="games[]"
                            id="games"
                            :scripts="false"
                            :error="$errors->has('games')"
                            route="select-games"
                            :default-option="trans_choice('game.games', 1)"
                            :label="trans_choice('game.choose', 2)">
                        </x-ui.select.async-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
{{--                        <x-libraries.choices--}}
{{--                            class="choices-genres"--}}
{{--                            id="genres"--}}
{{--                            name="genres[]"--}}
{{--                            :label="trans_choice('game_genre.choose', 2)"--}}
{{--                            error="genres"--}}
{{--                            multiple>--}}

{{--                            <x-ui.form.option value="">--}}
{{--                                {{ trans_choice('game_genre.genres', 2) }}--}}
{{--                            </x-ui.form.option>--}}

{{--                            @foreach($genres as $key => $genre)--}}
{{--                                <x-ui.form.option--}}
{{--                                    :value="$key"--}}
{{--                                    :selected="in_array($key, old('genres', []))">--}}
{{--                                    {{ $genre }}--}}
{{--                                </x-ui.form.option>--}}
{{--                            @endforeach--}}
{{--                        </x-libraries.choices>--}}

                        <x-ui.select.data-multiple
                            name="genres"
                            select-name="genres[]"
                            id="genres"
                            :options="$genres"
                            :label="trans_choice('game_genre.choose', 2)"
                            :default-option="trans_choice('game_genre.genres', 2)"
                            :scripts="false"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="platforms"
                            select-name="platforms[]"
                            :options="$platforms"
                            :label="trans_choice('game_platform.choose', 2)"
                            :default-option="trans_choice('game_platform.platforms', 2)"
                            :scripts="false"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.async-multiple
                            name="developers"
                            select-name="developers[]"
                            :error="$errors->has('developers')"
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
                            :error="$errors->has('publishers')"
                            route="select-game-publishers"
                            :default-option="trans_choice('game_publisher.publishers', 2)"
                            :label="trans_choice('game_publisher.choose', 2)">
                        </x-ui.select.async-multiple>
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
                        <x-ui.select.async
                            name="user"
                            select-name="user_id"
                            :error="$errors->has('user_id')"
                            route="select-users"
                            :default-option="trans_choice('user.choose', 1)"
                            :label="trans_choice('user.users', 1)">
                        </x-ui.select.async>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        <x-slot:sidebar></x-slot:sidebar>
    </x-admin.crud-form>

    @push('scripts')
        <script type="module">
            const games = document.querySelector('.games-select');
            const choicesGames = new Choices(games, {
                allowHTML: true,
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('common.loading') }}',
                noChoicesText: '{{ __('common.not_found') }}',
                searchPlaceholderValue: '{{ __('common.search') }}',
            });

            const genres = document.querySelector('.choices-genres');
            const genresChoices = new Choices(genres, {
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.nothing_else') }}',
            });

            const platforms = document.querySelector('.choices-platforms');
            const platformsChoices = new Choices(platforms, {
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.nothing_else') }}',
            });

            const asyncSearch = games.closest('.choices').querySelector('input[type=search]');

            asyncSearch.addEventListener(
                'input',
                debounce(event => choicesGames.setChoices(async () => {
                    try {
                        const query = asyncSearch.value ?? null
                        const response = await axios.post('{{ route('select-games') }}', {
                            query: query,
                        });
                        setTimeout(() => {
                            asyncSearch.focus();
                        }, 0);

                        return response.data.result;
                    } catch (err) {
                        @if(!app()->isProduction())
                            console.log(err);
                        @endif
                    }
                }, 'value', 'label', true), 700),
                false
            )


            let selectGames = document.querySelector(`[name="games[]"]`);

            let selectedForm = selectGames.closest('form');

            let options = selectGames.selectedOptions;

            selectGames.onchange = function () {

                const selectedInputs = document.getElementsByClassName('old_selected_games');

                while(selectedInputs.length > 0){
                    selectedInputs[0].parentNode.removeChild(selectedInputs[0]);
                }

                let values = Array.from(options).reduce(function(oldOptions, currentOption) {
                    oldOptions[currentOption.value] = currentOption.text;
                    return oldOptions;
                }, {});

                for (const key in values) {
                    if(key) {
                        const input = document.createElement("input");
                        input.type = "hidden";
                        input.className = "old_selected_games";
                        input.name = "old_selected_games[old][" + key + "]";
                        input.value = values[key];

                        selectedForm.appendChild(input);
                    }
                }


                let games = document.getElementById("games-select");
                let gamesData = [];
                let len = games.options.length;
                for (let i = 0; i < len; i++) {
                    const option = games.options[i];

                    if (option.selected) {
                        gamesData.push(option.value);
                    }
                }

                setData(gamesData);
            };



            async function setData(games) {
                try {
                    const response = await axios.post('{{ route('games-autocomplete') }}', {
                        games: games
                    });

                    const gameGenres = [];
                    response.data.result.forEach((game) => {
                        game.genres.forEach((genre) => {
                            gameGenres.push(genre.id.toString());
                        })
                    })

                    const gamePlatforms = [];
                    response.data.result.forEach((game) => {
                        game.platforms.forEach((platform) => {
                            gamePlatforms.push(platform.id.toString());
                        })
                    })

                    genresChoices.setChoiceByValue(gameGenres);
                    platformsChoices.setChoiceByValue(gamePlatforms);
                    // return response.data.result;
                } catch (err) {
                    @if(!app()->isProduction())
                    console.log(err);
                    @endif
                }
            }
        </script>
   @endpush
</x-layouts.admin>



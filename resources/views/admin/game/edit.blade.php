<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               method="put"
               id="edit-form"
               action="{{ route('games.update', $game->slug) }}"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('game.edit') }}
        </x-ui.title>

        <div class="crud-form__main">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            placeholder="{{ __('common.name') }}"
                            id="name"
                            name="name"
                            value="{{ $game->name }}"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            placeholder="{{ __('common.slug') }}"
                            id="slug"
                            name="slug"
                            value="{{ $game->slug }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.datepicker
                            placeholder="Дата релиза"
                            id="released_at"
                            name="released_at"
                            value="{{ $game->released_at }}">
                        </x-ui.form.datepicker>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-genres"
                            id="genres"
                            name="genres[]"
                            label="{{ __('game_genre.choose') }}"
                            multiple>
                            <x-ui.form.option value="">{{ __('game_genre.genre') }}</x-ui.form.option>

                            @foreach($genres as $genre)
                                <x-ui.form.option
                                    value="{{ $genre['id'] }}"
                                    :selected="in_array($genre['id'], $game->genres->pluck('id')->toArray())">
                                    {{ $genre['name'] }}
                                </x-ui.form.option>
                            @endforeach
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.async-select
                            :selected="$game->user ?? false"
                            name="user"
                            route="select-users"
                            default-option="{{ __('user.choose') }}"
                            label="{{ __('user.user') }}">
                        </x-ui.async-select>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        </div>

        <div class="crud-form__description">
            <x-ui.form.group>
                <x-libraries.rich-text-editor
                    name="description"
                    value="{!! $game->description !!}"
                    placeholder="{{ __('common.description') }}"/>
            </x-ui.form.group>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image
                    class="crud-form__input-image"
                    name="thumbnail"
                    id="thumbnail"
                    :path="$game->getThumbnailPath()">
                    @if($game->getThumbnailPath())
                    <x-slot:uploaded-thumbnail>
                        <x-ui.responsive-image
                            :model="$game"
                            :image-sizes="['small', 'medium', 'large']"
                            :path="$game->getThumbnailPath()"
                            :placeholder="false"
                            sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 220px">
                            <x-slot:img alt="test" title="test title"></x-slot:img>
                        </x-ui.responsive-image>
                    </x-slot:uploaded-thumbnail>
                    @endif
                    <p>{{ __('common.file.format') }} jpg, png</p>
                    <p>{{ __('common.file.max_size') }} 6Mb</p>
                </x-ui.form.input-image>
            </div>
        </div>

        <x-ui.form.group class="crud-form__submit">
            <x-ui.form.button
                class="crud-form__submit-button"
                x-bind:disabled="preventSubmit">
                    {{ __('common.save') }}
            </x-ui.form.button>
        </x-ui.form.group>
    </x-ui.form>

    @push('scripts')
        <script type="module">
            const genres = document.querySelector('.choices-genres');
            const choicesGenres = new Choices(genres, {
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.nothing_else') }}',
            });

            const platforms = document.querySelector('.choices-platforms');
            const choicesPlatforms= new Choices(platforms, {
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('common.not_found') }}',
                noChoicesText: '{{ __('common.nothing_else') }}',
            });
        </script>
    @endpush
</x-layouts.admin>

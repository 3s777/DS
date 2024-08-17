<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               id="create-form"
               action="{{ route('game-medias.store') }}"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('game_media.add') }}
        </x-ui.title>

        <div class="crud-form__main">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            placeholder="{{ trans_choice('common.name', 1) }}"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            placeholder="{{ __('common.slug') }}"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.datepicker
                            placeholder="{{ __('game_media.released_at') }}"
                            id="released_at"
                            name="released_at"
                            value="{{ old('released_at') }}">
                        </x-ui.form.datepicker>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            placeholder="{{ __('common.article_number') }}"
                            id="article_number"
                            name="article_number"
                            value="{{ old('article_number') }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.input-select
                            name="alternative_names"
                            placeholder="{{ __('common.alternative_names') }}"
                            default-option="{{ trans_choice('common.name', 2) }}"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.input-select
                            name="barcodes"
                            placeholder="{{ __('common.enter_barcodes') }}"
                            default-option="{{ trans_choice('common.barcodes', 1)  }}"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.data-select-multiple
                            name="genres"
                            :options="$genres"
                            placeholder="{{ __('game_genre.choose') }}"
                            default-option="{{ __('game_genre.genres') }}"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.data-select-multiple
                            name="platforms"
                            :options="$platforms"
                            placeholder="{{ __('game_platform.choose') }}"
                            default-option="{{ __('game_platform.platforms') }}"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.async-select-multiple
                            name="developers"
                            :error="$errors->has('developers')"
                            route="select-game-developers"
                            default-option="{{ __('game_developer.developer') }}"
                            label="{{ __('game_developer.choose') }}">
                        </x-ui.async-select-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="6" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.async-select-multiple
                            name="publishers"
                            :error="$errors->has('publishers')"
                            route="select-game-publishers"
                            default-option="{{ __('game_publisher.publisher') }}"
                            label="{{ __('game_publisher.choose') }}">
                        </x-ui.async-select-multiple>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.async-select
                            name="user"
                            :error="$errors->has('user_id')"
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
                    value=""
                    placeholder="{{ __('common.description') }}"/>
            </x-ui.form.group>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image
                    class="crud-form__input-image"
                    name="thumbnail"
                    id="thumbnail">
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
            const element4 = document.querySelector('.choices-select-4');
            const choices4 = new Choices(element4, {
                itemSelectText: '',
                placeholder: true,
                removeItems: true,
                removeItemButton: true,
                placeholderValue: '{{ trans_choice('common.name', 1) }}',
                noResultsText: '{{ __('Не найдено') }}',
                noChoicesText: '{{ __('Больше ничего нет') }}',
            });
        </script>
    @endpush
</x-layouts.admin>



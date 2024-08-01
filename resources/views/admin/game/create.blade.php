<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               id="create-form"
               action="{{ route('games.store') }}"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('game.add') }}
        </x-ui.title>

        <div class="crud-form__main">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            placeholder="{{ __('common.name') }}"
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
                            placeholder="{{ __('game.released_at') }}"
                            id="released_at"
                            name="released_at"
                            value="{{ old('released_at') }}">
                        </x-ui.form.datepicker>
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
                        <x-libraries.choices
                            class="choices-platforms"
                            id="platforms"
                            name="platforms[]"
                            error="platforms"
                            label="{{ __('game_platform.choose') }}"
                            multiple>
                            <x-ui.form.option value="">{{ __('game_platform.platform') }}</x-ui.form.option>
                            @foreach($platforms as $platform)
                                <x-ui.form.option
                                    value="{{ $platform['id'] }}"
                                    :selected="in_array($platform['id'], old('platforms', []))">
                                    {{ $platform['name'] }}
                                </x-ui.form.option>
                            @endforeach
                        </x-libraries.choices>
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

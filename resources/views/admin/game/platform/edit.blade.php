<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               method="put"
               id="edit-form"
               action="{{ route('game-platforms.update', $gamePlatform->slug) }}"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('game_platform.edit') }}
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
                            value="{{ $gamePlatform->name }}"
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
                            value="{{ $gamePlatform->slug }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            id="type"
                            name="type"
                            label="{{ __('game_platform.choose_type') }}">
                            <x-ui.form.option value="">{{ __('game_platform.choose_type') }}</x-ui.form.option>
                            @foreach($types as $type) {
                            <x-ui.form.option
                                value="{{ $type->value }}"
                                :selected="$gamePlatform->type == $type->value"
                            >{{ $type->name()}}</x-ui.form.option>
                            @endforeach
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.async-select
                            :selected="$gamePlatform->game_platform_manufacturer ?? false"
                            name="game_platform_manufacturer"
                            route="get-manufacturers"
                            label="{{ __('game_platform_manufacturer.manufacturer') }}"
                            default-option="{{ __('game_platform_manufacturer.choose') }}">
                        </x-ui.async-select>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.async-select
                            :selected="$gamePlatform->user ?? false"
                            name="user"
                            route="select-users"
                            label="{{ __('user.user') }}"
                            default-option="{{ __('user.choose') }}">
                        </x-ui.async-select>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        </div>

        <div class="crud-form__description">
            <x-ui.form.group>
                <x-libraries.rich-text-editor
                    name="description"
                    value="{!! $gamePlatform->description !!}"
                    placeholder="{{ __('common.description') }}"/>
            </x-ui.form.group>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image
                    class="crud-form__input-image"
                    name="thumbnail"
                    id="thumbnail"
                    :path="$gamePlatform->getThumbnailPath()">
                    @if($gamePlatform->getThumbnailPath())
                    <x-slot:uploaded-thumbnail>
                        <x-ui.responsive-image
                            :model="$gamePlatform"
                            :image-sizes="['small', 'medium', 'large']"
                            :path="$gamePlatform->getThumbnailPath()"
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
</x-layouts.admin>

<script type="module">
    const platformManufacturerType = document.querySelector('#type');
    const choicesPlatformManufacturerType = new Choices(platformManufacturerType, {
        itemSelectText: '',
        searchEnabled: false,
        shouldSort: false,
        noResultsText: '{{ __('Не найдено') }}',
        noChoicesText: '{{ __('Больше ничего нет') }}',
    });
</script>

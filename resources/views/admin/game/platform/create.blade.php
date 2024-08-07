<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               id="create-form"
               action="{{ route('game-platforms.store') }}"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('game_platform.add') }}
        </x-ui.title>

        <div class="crud-form__main">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            placeholder="{{ __('common.name') }} *"
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
                        <x-libraries.choices
                            id="type"
                            name="type"
                            label="{{ __('game_platform.choose_type') }}">
                            <x-ui.form.option value="">{{ __('game_platform.choose_type') }}</x-ui.form.option>
                            @foreach($types as $type) {
                                <x-ui.form.option value="{{ $type->value }}">{{ $type->name()}}</x-ui.form.option>
                            @endforeach
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.data-select
                            name="game_platform_manufacturer_id"
                            :options="$manufacturers"
                            default-option="{{__('game_platform_manufacturer.manufacturer')}}"
                            placeholder="{{ __('game_platform_manufacturer.choose') }}" />
                    </x-ui.form.group>
                </x-grid.col>

{{--                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">--}}
{{--                    <x-ui.form.group>--}}
{{--                        <x-ui.async-select--}}
{{--                            name="game_platform_manufacturer"--}}
{{--                            route="select-game-platform-manufacturers"--}}
{{--                            label="{{ __('game_platform_manufacturer.manufacturer') }}"--}}
{{--                            default-option="{{ __('game_platform_manufacturer.choose') }}">--}}
{{--                        </x-ui.async-select>--}}
{{--                    </x-ui.form.group>--}}
{{--                </x-grid.col>--}}

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.async-select
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

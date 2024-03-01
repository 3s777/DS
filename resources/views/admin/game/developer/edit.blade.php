<x-layouts.admin title="{{ __('game.developer.edit') }}" :search="false">

    <div class="crud-form">
        <x-ui.form method="put" id="edit-form" action="{{ route('game-developers.update', $gameDeveloper->slug) }}">
            <x-grid type="container">
                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            placeholder="{{ __('common.name') }}"
                            id="name"
                            name="name"
                            value="{{ $gameDeveloper->name }}"
                            required
                            autocomplete="on"
                            autofocus >
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            placeholder="{{ __('common.slug') }}"
                            id="slug"
                            name="slug"
                            value="{{ $gameDeveloper->slug }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.filepond
                            class="filepond1"
                            name="filepond"
                            accept="image/png, image/jpeg, image/gif"
                            multiple>
                        </x-libraries.filepond>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.rich-text-editor
                            name="description"
                            value="{!! $gameDeveloper->description !!}"
                            placeholder="{{ __('common.description') }}" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.button>{{ __('common.save') }}</x-ui.form.button>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        </x-ui.form>
    </div>

    @push('scripts')
        <script type="module">
            const inputElement = document.querySelector('.filepond1');

            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
            );

            const pond = FilePond.create(inputElement, {
                credits: false,
                labelIdle: '<span class="filepond--label-action"> {{ __('common.upload') }}</span> {{ __('common.image') }} '
            });
        </script>
    @endpush
</x-layouts.admin>

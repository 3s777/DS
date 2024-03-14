<x-layouts.admin title="{{ __('game.developer.add') }}" :search="false">

    <div class="crud-form">
        <x-ui.form id="create-form" action="{{ route('game-developers.store') }}">
            <x-grid type="container">
                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            placeholder="{{ __('common.name') }}"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
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
                            value="{{ old('slug') }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.filepond
                            class="filepond1"
                            name="thumbnail[avatar]"
                            accept="image/png, image/jpeg">
                        </x-libraries.filepond>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.filepond
                            class="filepond2"
                            name="thumbnail[thumbnail]"
                            accept="image/png, image/jpeg">
                        </x-libraries.filepond>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.rich-text-editor
                            name="description"
                            value=""
                            placeholder="{{ __('common.description') }}" />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.button x-bind:disabled="preventSubmit">{{ __('common.add') }}</x-ui.form.button>
                    </x-ui.form.group>
                </x-grid.col>

            </x-grid>
        </x-ui.form>
    </div>

    @push('scripts')
        <script type="module">
            const inputElement = document.querySelector('.filepond1');
            const inputElement2 = document.querySelector('.filepond2');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
                imagePreviewHeight: 100,
                labelIdle: '<span class="filepond--label-action"> {{ __('common.upload') }}</span> {{ __('common.image') }} ',
                server: {
                    process: '{{ route('uploads.process') }}',
                    fetch: null,
                    revert: null,
                    onerror: (response) => console.log('sxvc'),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    }
                }
            });

            const pond2 = FilePond.create(inputElement2, {
                credits: false,
                imagePreviewHeight: 100,
                labelIdle: '<span class="filepond--label-action"> {{ __('common.upload') }}</span> {{ __('common.image') }} ',
                server: {
                    process: '{{ route('uploads.process') }}',
                    fetch: null,
                    revert: null,
                    onerror: 'vxcxvc',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    }
                }
            });
        </script>
    @endpush
</x-layouts.admin>

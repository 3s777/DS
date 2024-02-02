<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="admin" wrapper-class="admin__content">
            <x-slot:sidebar>
                <x-common.sidebar-menu class="admin__menu" />
            </x-slot:sidebar>

            <x-ui.title size="normal" indent="big">Добавить игрового разработчика</x-ui.title>

            <x-common.messages />

            <div class="create-game-developer">
                <form action="{{ route('game-developers.store') }}" method="POST" id="create-form">
                    @csrf
                    <x-grid type="container">
                        <x-grid.col xl="4" lg="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    :errors="$errors"
                                    placeholder="Название"
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
                                    placeholder="Префикс"
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
                                    value=""
                                    placeholder="{{ __('game-developer.description') }}" />
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="12" lg="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button>Добавить</x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>

                    </x-grid>
                </form>


                <x-ui.form.group>
                    <x-libraries.rich-text-editor
                        name="description2"
                        value=""
                        placeholder="{{ __('game-developer.description') }}" />
                </x-ui.form.group>

            </div>
        </x-common.content>
    </x-grid.container>

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
                labelIdle: '<span class="filepond--label-action"> {{ __('Загрузите') }}</span> {{ __('главное фото') }} '
            });
        </script>
    @endpush
</x-layouts.main>

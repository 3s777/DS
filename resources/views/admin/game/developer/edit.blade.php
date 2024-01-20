<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="admin" wrapper-class="admin__content">
            <x-slot:sidebar>
                <x-common.sidebar-menu class="admin__menu" />
            </x-slot:sidebar>

            <x-ui.title size="normal" indent="big">Добавить игрового разработчика</x-ui.title>

            <x-common.messages />

            <div class="edit-game-developer">
                <form action="{{ route('game-developers.update', $gameDeveloper->slug) }}" method="POST">
                    @csrf
                    @method('put')
                    <x-grid type="container">
                        <x-grid.col xl="4" lg="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.input-text
                                    :errors="$errors"
                                    placeholder="Название"
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
                                    placeholder="Префикс"
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
                                <div id="editor">
                                    {{ $gameDeveloper->description }}
                                </div>
                            </x-ui.form.group>
                        </x-grid.col>

                        <x-grid.col xl="12" lg="6" md="6" sm="12">
                            <x-ui.form.group>
                                <x-ui.form.button>Сохранить</x-ui.form.button>
                            </x-ui.form.group>
                        </x-grid.col>
                    </x-grid>
                </form>
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

            var toolbarOptions = [
                ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                [{ 'align': [] }],
                ['blockquote'],
                [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                ['clean']                                         // remove formatting button
            ];

            var quill = new Quill('#editor', {
                modules: {
                    toolbar: toolbarOptions
                },
                placeholder: 'Краткое описание разработчика',
                theme: 'snow'
            });
        </script>
    @endpush
</x-layouts.main>

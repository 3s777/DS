<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
            <x-common.content class="admin" wrapper-class="admin__content">
                <x-slot:sidebar>
                    <x-common.sidebar-menu class="admin__menu" />
                </x-slot:sidebar>

                    <x-ui.title size="normal" indent="big">Добавить игровой носитель</x-ui.title>
                    <div class="add-game-carrier">
                        <form action="">
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
                                            autocomplete="on">
                                        </x-ui.form.input-text>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col xl="4" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.input-text
                                            :errors="$errors"
                                            placeholder="Код носителя"
                                            id="name"
                                            name="name"
                                            value="{{ old('name') }}"
                                            required
                                            autocomplete="on">
                                        </x-ui.form.input-text>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col xl="4" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.choices
                                            class="choices-select-auto"
                                            id="select-test"
                                            name="select-test"
                                            label="Выберите платформу">
                                            <x-ui.form.option>Платформа</x-ui.form.option>
                                            <x-ui.form.option value="1">Playstation 3</x-ui.form.option>
                                            <x-ui.form.option value="1">X-box 360</x-ui.form.option>
                                            <x-ui.form.option value="2">NES</x-ui.form.option>
                                        </x-libraries.choices>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col xl="4" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.choices
                                            class="choices-select-auto"
                                            id="select-test"
                                            name="select-test"
                                            label="Выберите игру">
                                            <x-ui.form.option>Выберите игру</x-ui.form.option>
                                            <x-ui.form.option value="1">GTA5</x-ui.form.option>
                                            <x-ui.form.option value="1">Half Life</x-ui.form.option>
                                            <x-ui.form.option value="2">Return to castle Wolfenstein</x-ui.form.option>
                                        </x-libraries.choices>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col xl="4" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.choices
                                            class="choices-select-auto"
                                            id="select-test"
                                            name="select-test"
                                            label="Тип издания">
                                            <x-ui.form.option>Выберите формат</x-ui.form.option>
                                            <x-ui.form.option value="1">Classic</x-ui.form.option>
                                            <x-ui.form.option value="1">Essentials</x-ui.form.option>
                                            <x-ui.form.option value="2">Platinum</x-ui.form.option>
                                            <x-ui.form.option value="2">Limited</x-ui.form.option>
                                        </x-libraries.choices>
                                    </x-ui.form.group>
                                </x-grid.col>

                                <x-grid.col xl="4" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.choices
                                            class="choices-select-2"
                                            id="select-test-2"
                                            name="select-test-2"
                                            label="Выберите языки" multiple>
                                            <x-ui.form.option>Языки</x-ui.form.option>
                                            <x-ui.form.option value="1" selected>Английский</x-ui.form.option>
                                            <x-ui.form.option value="2">Русский</x-ui.form.option>
                                            <x-ui.form.option value="3">Японский</x-ui.form.option>
                                        </x-libraries.choices>
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
                                <x-grid.col xl="4" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.filepond
                                            class="filepond2"
                                            name="filepond"
                                            multiple
                                            data-allow-reorder="true"
                                            data-max-file-size="3MB"
                                            data-max-files="3">
                                        </x-libraries.filepond>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col xl="12" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <div id="editor">
                                            <h1>Hello World!</h1>
                                            <p>Some initial <strong>bold</strong> text</p>
                                        </div>
                                    </x-ui.form.group>
                                </x-grid.col>
                            </x-grid>
                        </form>
                    </div>
            </x-common.content>
    </x-grid.container>

    @push('scripts')
        <script type="module">
            var selects = document.getElementsByClassName("choices-select-auto");
            for (var i = 0; i < selects.length; i++) {
                new Choices(selects.item(i), {
                    itemSelectText: '',
                    searchEnabled: false,
                    shouldSort: false,
                    allowHTML: true,
                    noResultsText: '{{ __('Не найдено') }}',
                    noChoicesText: '{{ __('Больше ничего нет') }}',
                });
            }

            const element2 = document.querySelector('.choices-select-2');
            const choices2 = new Choices(element2, {
                itemSelectText: '',
                removeItems: true,
                removeItemButton: true,
                noResultsText: '{{ __('Не найдено') }}',
                noChoicesText: '{{ __('Больше ничего нет') }}',
            });

            const inputElement = document.querySelector('.filepond1');
            const inputElement2 = document.querySelector('.filepond2');

            const pond2 = FilePond.create(inputElement2, {
                credits: false,
                labelIdle: '<span class="filepond--label-action"> {{ __('Загрузите') }}</span> {{ __('дополнительные фото') }}',
                labelMaxFileSizeExceeded: 'Файл слишком большой',
                labelMaxFileSize: 'Максимальный размер {filesize}',
                labelFileLoading: 'Загрузка',
                labelTapToCancel: 'отменить',
                labelFileWaitingForSize: 'подождите'
            });

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
                placeholder: 'Compose an epic...',
                theme: 'snow'
            });
        </script>
    @endpush
</x-layouts.main>

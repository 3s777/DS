<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="profile">
            <x-slot:sidebar>
                <nav class="content__sidebar-menu">
                    <x-ui.form.button
                        class="content__sidebar-link"
                        tag="a"
                        color="light">
                        Личные настройки
                    </x-ui.form.button>
                    <x-ui.form.button
                        class="content__sidebar-link"
                        tag="a"
                        color="light">
                        Конфиденциальность
                    </x-ui.form.button>
                </nav>
            </x-slot:sidebar>
            <x-ui.title indent="normal">Настройки профиля</x-ui.title>
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

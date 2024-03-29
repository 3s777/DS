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
                <x-grid.col xl="4" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.filepond
                            multiple
                            class="filepond3"
                            name="thumbnail"
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

    <form action="{{ route('filepond.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="thumbnail[test]" type="file">
        <input name="thumbnail[test2]" type="file">


        <input class="testinput" type="file" multiple onchange="previewFile()"><br>
        <img class="test" src="" height="200" alt="Image preview...">


{{--        <input type="hidden" name="thumbnail[thumbnail]" value="tmp/1710488105-rDOMzR3aYnpMnimR76On/eXEPyGlvHanQfNdZvNX0xrTJ9hzEj3lukvW4jJLu.png">--}}
        <input type="submit" value="f">
    </form>

    <form x-data="imgPreview" x-cloak>
        <label for="imgSelect">Select an Image:</label>
        <input type="file" id="imgSelect" accept="image/*" x-ref="myFile" @change="previewFile">
        <template x-if="imgsrc">
            <p>
                <img :src="imgsrc" class="imgPreview">
            </p>
        </template>
    </form>

    @push('scripts')
        <script type="module">
            const inputElement = document.querySelector('.filepond1');
            const inputElement2 = document.querySelector('.filepond2');
            const inputElement3 = document.querySelector('.filepond3');
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
                    process: '{{ route('filepond.upload') }}',
                    revert: '{{ route('filepond.delete') }}',
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
                    process: '{{ route('filepond.upload') }}',
                    revert: '{{ route('filepond.delete') }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    }
                }
            });

            const pond3 = FilePond.create(inputElement3, {
                credits: false,
                imagePreviewHeight: 100,
                labelIdle: '<span class="filepond--label-action"> {{ __('common.upload') }}</span> {{ __('common.image') }} ',
                server: {
                    process: '{{ route('filepond.upload') }}',
                    revert: '{{ route('filepond.delete') }}',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    }
                }
            });
        </script>

        <script>
            function previewFile() {
                var preview = document.querySelector('.test');
                var file    = document.querySelector('.testinput').files[0];
                var reader  = new FileReader();

                reader.onloadend = function () {
                    preview.src = reader.result;
                }

                if (file) {
                    reader.readAsDataURL(file);
                } else {
                    preview.src = "";
                }
            }


            document.addEventListener('alpine:init', () => {
                Alpine.data('imgPreview', () => ({
                    imgsrc:null,
                    previewFile() {
                        let file = this.$refs.myFile.files[0];
                        if(!file || file.type.indexOf('image/') === -1) return;
                        this.imgsrc = null;
                        let reader = new FileReader();

                        reader.onload = e => {
                            this.imgsrc = e.target.result;
                        }

                        reader.readAsDataURL(file);

                    }
                }))
            });
        </script>
    @endpush
</x-layouts.admin>

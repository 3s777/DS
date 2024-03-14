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

    <form action="{{ route('uploads.process') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input name="thumbnail" type="file">

        <input type="submit" value="f">
    </form>

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
                    process: (fieldName, file, metadata, load, error, progress, abort, transfer, options) => {
                        // fieldName is the name of the input field
                        // file is the actual file object to send
                        const formData = new FormData();
                        formData.append(fieldName, file, file.name);

                        const request = new XMLHttpRequest();
                        request.open('POST', '{{ route('uploads.process') }}');

                        // Should call the progress method to update the progress to 100% before calling load
                        // Setting computable to false switches the loading indicator to infinite mode
                        request.upload.onprogress = (e) => {
                            progress(e.lengthComputable, e.loaded, e.total);
                        };

                        // Should call the load method when done and pass the returned server file id
                        // this server file id is then used later on when reverting or restoring a file
                        // so your server knows which file to return without exposing that info to the client
                        request.onload = function () {
                            if (request.status >= 200 && request.status < 300) {
                                // the load method accepts either a string (id) or an object
                                load(request.responseText);
                            } else {
                                console.log('sdfsdx');
                                error('oh no');
                            }
                        };

                        request.onerror = function () {
                            consoloe.log('xxx');
                        }

                        request.send(formData);

                        // Should expose an abort method so the request can be cancelled
                        return {
                            abort: () => {
                                // This function is entered if the user has tapped the cancel button
                                request.abort();

                                // Let FilePond know the request has been cancelled
                                abort();
                            },
                        };
                    },
                },
                {{--server: {--}}
                {{--    process: '{{ route('uploads.process') }}',--}}
                {{--    fetch: null,--}}
                {{--    revert: null,--}}
                {{--    onerror: (response) => console.log('sxvc'),--}}
                {{--    headers: {--}}
                {{--        'X-CSRF-TOKEN': csrfToken,--}}
                {{--    }--}}
                {{--}--}}
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

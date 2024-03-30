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
            @php
                $imgPath = pathinfo($gameDeveloper->thumb_path);
                dump($imgPath);
            @endphp
{{--<div class="crud-form__test">--}}
{{--    {{ $gameDeveloper->getFirstMedia('thumbnails') }}--}}
{{--</div>--}}

<div style="width: 50%">
    <picture>
        <source
            type="image/webp"
            srcset="
                    {{ asset('storage/images/'.$imgPath['dirname'].'/webp/300x300/'.$imgPath['filename'].'.webp') }} 300w,
                    {{ asset('storage/images/'.$imgPath['dirname'].'/webp/400x400/'.$imgPath['filename'].'.webp') }} 400w,
                    {{ asset('storage/images/'.$imgPath['dirname'].'/webp/550x550/'.$imgPath['filename'].'.webp') }} 550w,
                    {{ asset('storage/images/'.$imgPath['dirname'].'/webp/600x600/'.$imgPath['filename'].'.webp') }} 600w,
                    {{ asset('storage/images/'.$imgPath['dirname'].'/webp/1000x1000/'.$imgPath['filename'].'.webp') }} 1000w,
                    {{ asset('storage/images/'.$imgPath['dirname'].'/webp/1200x1200/'.$imgPath['filename'].'.webp') }} 1200w,
                    {{ asset('storage/images/'.$imgPath['dirname'].'/'.$imgPath['filename'].'.webp') }} 2048w,
            "
            sizes="
                (max-width: 1024px) 100vw,
                (max-width: 1400px) 30vw,
                550px
            "
        />
        <img
            style="max-width: 100%"
            src="{{ asset('storage/images/'.$gameDeveloper->thumb_path) }}"
            loading="lazy"
            decoding="async"
            alt="Test image"
            title="Test image"
        />
    </picture>
</div>







{{--            <picture>--}}
{{--                <source--}}
{{--                    type="image/webp"--}}
{{--                    srcset="--}}
{{--                        {{ asset('/storage/test-300.webp') }} 300w,--}}
{{--                        {{ asset('/storage/test-650.webp') }} 650w,--}}
{{--                        {{ asset('/storage/test-800.webp') }} 800w,--}}
{{--                        {{ asset('/storage/test-1200.webp') }} 1200w,--}}
{{--                        {{ asset('/storage/test-1500.webp') }} 1500w,--}}
{{--                        {{ asset('/storage/test.webp') }} 3000w,--}}
{{--                    "--}}
{{--                    sizes="--}}
{{--                        (max-width: 700px) 280px,--}}
{{--                        (max-width: 1000px) 740px,--}}
{{--                        (max-width: 1900px) 1500px,--}}
{{--                        100vw--}}
{{--                    "--}}
{{--                />--}}
{{--                <img--}}
{{--                    style="max-width: 100%"--}}
{{--                    src="{{ asset('/storage/test.jpg') }}"--}}
{{--                    srcset="--}}
{{--                        {{ asset('/storage/test-300.jpg') }} 300w,--}}
{{--                        {{ asset('/storage/test-650.jpg') }} 650w,--}}
{{--                        {{ asset('/storage/test-800.jpg') }} 800w,--}}
{{--                        {{ asset('/storage/test-1200.jpg') }} 1200w,--}}
{{--                        {{ asset('/storage/test-1500.jpg') }} 1500w,--}}
{{--                        {{ asset('/storage/test.jpg') }} 3000w,--}}
{{--                    "--}}
{{--                    sizes="--}}
{{--                        (max-width: 700px) 280px,--}}
{{--                        (max-width: 1000px) 740px,--}}
{{--                        (max-width: 1900px) 1500px,--}}
{{--                        100vw--}}
{{--                    "--}}
{{--                    loading="lazy"--}}
{{--                    decoding="async"--}}
{{--                    alt="Test image"--}}
{{--                    title="Test image"--}}
{{--                />--}}
{{--            </picture>--}}






{{--            <img src="{{ asset('storage/images/'.$gameDeveloper->thumb_path) }}" alt="">--}}
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

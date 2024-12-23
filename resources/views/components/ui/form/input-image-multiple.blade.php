@props([
    'id',
    'name',
    'path' => false,
    'uploadedThumbnail' => false,
])

<div x-data="imgPreview" {{ $attributes->class([
                'input-image-multiple__wrapper',
            ])
        }} x-cloak>
    <div class="input-image-multiple">
        <div class="input-image-multiple__preview" :class="imgSrc || uploadedSrc ? 'input-image-multiple__preview_hidden' : ''">
            <div class="input-image-multiple__placeholder" x-show="!imgSrc && !uploadedSrc">
                <div class="input-image-multiple__placeholder-text">
                    {{ $slot }}
                </div>
            </div>

            @if($uploadedThumbnail)
                <template x-if="uploadedSrc">
                    <div class="input-image-multiple__inner">
                        <x-ui.badge class="input-image-multiple__close" @click="clearUploaded" title="{{ __('common.delete') }}">
                            <x-svg.close></x-svg.close>
                        </x-ui.badge>
                        {{ $uploadedThumbnail }}
                    </div>
                </template>
            @endif


            <template x-if="imgArr">
                <template x-for="image in imgArr">
                    <template x-if="image">
                    <div class="input-image-multiple__preview-item">
                        <x-ui.badge class="input-image-multiple__close" @click="clearFile(image)" title="{{ __('common.delete') }}">
                            <x-svg.close></x-svg.close>
                        </x-ui.badge>
                        <img :src="image" class="imgPreview">
                    </div>
                    </template>

                </template>
            </template>

{{--            <template x-if="imgSrc">--}}
{{--                <div class="input-image-multiple__inner">--}}
{{--                    <x-ui.badge class="input-image-multiple__close" @click="clearFile" title="{{ __('common.delete') }}">--}}
{{--                        <x-svg.close></x-svg.close>--}}
{{--                    </x-ui.badge>--}}
{{--                    <img :src="imgSrc" class="imgPreview">--}}
{{--                </div>--}}
{{--            </template>--}}


        </div>









        <x-ui.form.button class="input-image-multiple__submit" tag="label" for="{{ $id }}">
            {{ __('common.choose_image') }}
        </x-ui.form.button>
        <input type="file" multiple hidden id="{{ $id }}"  name="{{ $name }}" accept="image/png, image/jpeg" x-ref="uploadedImages" @change="previewFile">

        @if($path)
            <input type="text" value="{{ $path }}" hidden id="{{ $id }}_uploaded" x-ref="uploadedFile"  name="{{ $name }}_uploaded">
        @endif
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('imgPreview', () => ({
                        imgSrc:null,
                        imgArr:null,
                        @if($uploadedThumbnail)
                        uploadedSrc:true,
                        @else
                        uploadedSrc:false,
                        @endif
                        images() {
                            return Array.from(this.$refs.uploadedImages.files);
                        },
                        previewFile() {
                            const files = this.$refs.uploadedImages.files;
                            const fileArray = [];
                            const readers = [];


                            for (let i = 0; i < files.length; i++) {
                                const file = files[i];
                                const reader = new FileReader();

                                const fileReadPromise = new Promise((resolve, reject) => {
                                    reader.onload = function(event) {

                                        fileArray.splice(i, 0, event.target.result);
                                        resolve();
                                    };
                                    reader.readAsDataURL(file);
                                });

                                readers.push(fileReadPromise);
                            }


                            Promise.all(readers)
                                .then(() => {
                                    this.imgArr = fileArray;
                                })
                                .catch(error => {
                                    console.error(error);
                                });

                            console.log(this.imgArr);
                            console.log(this.$refs.uploadedImages.files);

                        },
                        clearFile(image) {

                            let imageIndex = this.imgArr.indexOf(image);

                            if (imageIndex !== -1) {

                                this.imgArr.splice(imageIndex, 1);
                            }
                            //
                            const files = Array.from(this.$refs.uploadedImages.files);

                            files.splice(imageIndex, 1);

                            const dataTransfer = new DataTransfer();

                            files.forEach(file => {
                                dataTransfer.items.add(file);
                            });

                            let fileInput = document.getElementById('{{ $id }}');

                            fileInput.files = dataTransfer.files;

                            //     console.log(imageIndex);
                            // console.log(this.imgArr);
                            // console.log(this.$refs.uploadedImages.files);
                            //
                            //
                            //
                            // console.log(dataTransfer.files);
                            //
                            // console.log(this.$refs.uploadedImages.files);

                            // this.$refs.uploadedImages.files.splice(imageIndex, 1);

                            // this.imgSrc = null;
                            // this.$refs.uploadedImages.value = null;
                        },
                        clearUploaded() {
                            this.uploadedSrc = null;
                            this.$refs.uploadedFile.value = null;
                        }
                    })
                )
            });
        </script>
    @endpush
@endonce

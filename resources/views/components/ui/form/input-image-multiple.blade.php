@props([
    'id',
    'name',
    'path' => false,
    'uploadedThumbnail' => false,
])

<div x-data="imgPreview" {{ $attributes->class([
                'input-image__wrapper',
            ])
        }} x-cloak>
    <div class="input-image">
        <div class="input-image__preview" :class="imgSrc || uploadedSrc ? 'input-image__preview_hidden' : ''">
            <div class="input-image__placeholder" x-show="!imgSrc && !uploadedSrc">
                <div class="input-image__placeholder-text">
                    {{ $slot }}
                </div>
            </div>

            @if($uploadedThumbnail)
                <template x-if="uploadedSrc">
                    <div class="input-image__inner">
                        <x-ui.badge class="input-image__close" @click="clearUploaded" title="{{ __('common.delete') }}">
                            <x-svg.close></x-svg.close>
                        </x-ui.badge>
                        {{ $uploadedThumbnail }}
                    </div>
                </template>
            @endif

            <template x-if="imgSrc">
                <div class="input-image__inner">
                    <x-ui.badge class="input-image__close" @click="clearFile" title="{{ __('common.delete') }}">
                        <x-svg.close></x-svg.close>
                    </x-ui.badge>
                    <img :src="imgSrc" class="imgPreview">
                </div>
            </template>

            <template x-for="image in images">
                <img :src="previewFile(image)" class="imgPreview">
            </template>
        </div>
        <x-ui.form.button class="input-image__submit" tag="label" for="{{ $id }}">
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
                        images:null,
                        @if($uploadedThumbnail)
                            uploadedSrc:true,
                        @else
                            uploadedSrc:false,
                        @endif
                        previewFile(image) {
                            let imgSrc = null;
                            // let file = this.$refs.uploadedImages.files[0];
                            //
                            // let images = Array.from(this.$refs.uploadedImages.files);



                            // files.forEach((item) => {
                            //         console.log(item)
                            //     }
                            //
                            // )

                            if(!image || image.type.indexOf('image/') === -1) {
                                imgSrc = null;
                                this.uploadedSrc = null;
                                return;
                            }
                            imgSrc = null;
                            let reader = new FileReader();

                            reader.onload = e => {
                                this.uploadedSrc = null;
                                imgSrc = e.target.result;
                            }

                            reader.readAsDataURL(image);

                            return imgSrc;
                        },
                        clearFile() {
                            this.imgSrc = null;
                            this.$refs.uploadedImages.value = null;
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

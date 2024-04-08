@props([
    'id',
    'name',
    'path' => false,
    'uploadedThumbnail' => false,
])

<div x-data="imgPreview" x-cloak>
    <div class="input-image"
        {{ $attributes->class([
                'input-image',
            ])
        }}>
        <div class="input-image__preview" :class="imgSrc || uploadedSrc ? 'input-image__preview_hidden' : ''">
            <div class="input-image__placeholder" x-show="!imgSrc && !uploadedSrc">
                <div class="input-image__placeholder-text">
                    {{ $slot }}
                </div>
            </div>

            @if($uploadedThumbnail)
                <template x-if="uploadedSrc">
                    <div class="input-image__wrapper">
                        <x-ui.badge class="input-image__close" @click="clearUploaded" title="Удалить">
                            <x-svg.close></x-svg.close>
                        </x-ui.badge>
                        {{ $uploadedThumbnail }}
                    </div>
                </template>
            @endif

            <template x-if="imgSrc">
                <div class="input-image__wrapper">
                    <x-ui.badge class="input-image__close" @click="clearFile" title="Удалить">
                        <x-svg.close></x-svg.close>
                    </x-ui.badge>
                    <img :src="imgSrc" class="imgPreview">
                </div>
            </template>
        </div>
        <x-ui.form.button class="input-image__submit" tag="label" for="{{ $id }}">
            {{ __('Выберите изображение') }}
        </x-ui.form.button>
        <input type="file" hidden id="{{ $id }}"  name="{{ $name }}" accept="image/png, image/jpeg" x-ref="myFile" @change="previewFile">

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
                        @if($uploadedThumbnail)
                            uploadedSrc:true,
                        @else
                            uploadedSrc:false,
                        @endif
                        previewFile() {
                            let file = this.$refs.myFile.files[0];
                            if(!file || file.type.indexOf('image/') === -1) {
                                this.imgSrc = null;
                                this.uploadedSrc = null;
                                return;
                            }
                            this.imgSrc = null;
                            let reader = new FileReader();

                            reader.onload = e => {
                                this.uploadedSrc = null;
                                this.imgSrc = e.target.result;
                            }

                            reader.readAsDataURL(file);
                        },
                        clearFile() {
                            this.imgSrc = null;
                            this.$refs.myFile.value = null;
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

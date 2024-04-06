@props([
    'id',
    'name',
    'path' => false,
    'thumbnail' => false,
])

<div x-data="imgPreview" x-cloak>
    <div class="input-image"
        {{ $attributes->class([
                'input-image',
            ])
        }}>
        <div class="input-image__preview" :class="imgSrc || thumbnailSrc ? 'input-image__preview_hidden' : ''">
            <div class="input-image__placeholder" x-show="!imgSrc && !thumbnailSrc">
                <div class="input-image__placeholder-text">
                    {{ $slot }}
                </div>
            </div>

            @if($thumbnail)
                <template x-if="thumbnailSrc">
                    <div class="input-image__wrapper">
                        <x-ui.badge class="input-image__close" @click="clearThumbnail" title="Удалить">
                            <x-svg.close></x-svg.close>
                        </x-ui.badge>
                        {{ $thumbnail }}
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
            <input type="text" value="{{ $path }}" hidden id="{{ $id }}_selected" x-ref="selectedFile"  name="{{ $name }}_selected">
        @endif
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('imgPreview', () => ({
                        imgSrc:null,
                        @if($thumbnail)
                            thumbnailSrc:true,
                        @else
                            thumbnailSrc:false,
                        @endif
                        previewFile() {
                            let file = this.$refs.myFile.files[0];
                            if(!file || file.type.indexOf('image/') === -1) {
                                this.imgSrc = null;
                                this.thumbnailSrc = null;
                                return;
                            }
                            this.imgSrc = null;
                            let reader = new FileReader();

                            reader.onload = e => {
                                this.thumbnailSrc = null;
                                this.imgSrc = e.target.result;
                            }

                            reader.readAsDataURL(file);
                        },
                        clearFile() {
                            this.imgSrc = null;
                            this.$refs.myFile.value = null;
                        },
                        clearThumbnail() {
                            this.thumbnailSrc = null;
                            this.$refs.selectedFile.value = null;
                        }
                    })
                )
            });
        </script>
    @endpush
@endonce

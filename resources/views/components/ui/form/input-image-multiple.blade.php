@props([
    'id',
    'name',
    'buttonText' => trans_choice('common.choose_image', 2),
    'model' => false,
    'imageSizes' => false,
    'sizes' => false
])

<div x-data="imgPreviews" {{ $attributes->class(['input-image-multiple__wrapper']) }} x-cloak>
    <div class="input-image-multiple">
        <div class="input-image-multiple__preview">
            <div class="input-image-multiple__placeholder" x-show="!imgArr && !placeholder">
                <div class="input-image-multiple__placeholder-text">
                    {{ $slot }}
                </div>
            </div>

            @if($model)
                @foreach($model->getImages() as $image)
                    <div class="input-image-multiple__preview-item">
                        <x-ui.badge class="input-image-multiple__close" @click="clearUploaded" data-src="{{ $image }}" title="{{ __('common.delete') }}">
                            <x-svg.close></x-svg.close>
                        </x-ui.badge>
                            <x-ui.responsive-image
                                :model="$model"
                                :image-sizes="$imageSizes"
                                :path="$image"
                                :placeholder="false"
                                :sizes="$sizes">
                                <x-slot:img alt=""></x-slot:img>
                            </x-ui.responsive-image>
                    </div>
                @endforeach
            @endif

            <template x-if="imgArr">
                <template x-for="(image, index) in imgArr">
                    <div class="input-image-multiple__preview-item">
                        <x-ui.badge class="input-image-multiple__close" @click="clearFile(image, index)" title="{{ __('common.delete') }}">
                            <x-svg.close></x-svg.close>
                        </x-ui.badge>
                        <img :src="image" class="imgPreview">
                    </div>
                </template>
            </template>
        </div>

        <x-ui.form.button class="input-image-multiple__submit" tag="label" for="{{ $id }}">
            {{ $buttonText }}
        </x-ui.form.button>

        <input type="file" multiple hidden id="{{ $id }}"  name="{{ $name }}" accept="image/png, image/jpeg" x-ref="uploadedImages" @change="previewFiles">

        <input type="text" value="" hidden id="{{ $id }}_delete" x-ref="imagesForDeleteStr"  name="{{ to_dot_name($name) }}_delete">
    </div>
</div>

@once
    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('imgPreviews', () => ({
                        imgArr: null,
                        uploadedFiles: null,
                        @if($model)
                            placeholder:{{ count($model->getImages()) }},
                        @else
                            placeholder:false,
                        @endif
                        previewFiles(refresh = true) {
                            const readers = [];

                            const arr = {};

                            if(this.uploadedFiles && refresh) {
                                const filesUploadedEarlier = Array.from(this.$refs.uploadedImages.files);

                                const dataTransfer = new DataTransfer();

                                filesUploadedEarlier.forEach(file => {
                                    dataTransfer.items.add(file);
                                });

                                this.uploadedFiles.forEach(file => {
                                    dataTransfer.items.add(file);
                                });

                                let fileInput = document.getElementById('{{ $id }}');

                                fileInput.files = dataTransfer.files;

                                this.uploadedFiles = Array.from(fileInput.files);
                            }

                            const files = this.$refs.uploadedImages.files;

                            for (let i = 0; i < files.length; i++) {
                                const file = files[i];

                                const reader = new FileReader();

                                const fileReadPromise = new Promise((resolve, reject) => {
                                    reader.onload = function(event) {
                                        arr[i] = event.target.result;
                                        // arr.set(i,2);
                                        // fileArray.splice(i, 0, event.target.result);
                                        resolve();
                                    };
                                    reader.readAsDataURL(file);
                                });

                                readers.splice(i, 0, fileReadPromise);
                            }

                            Promise.all(readers)
                                .then(() => {
                                    this.imgArr = arr;
                                    if(Object.keys(arr).length === 0) {
                                        this.imgArr = null;
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                });

                            this.uploadedFiles = Array.from(files);
                        },
                        clearFile(image, imageIndex) {
                            if (imageIndex !== -1) {
                                delete this.imgArr[imageIndex];
                            }

                            const files = Array.from(this.$refs.uploadedImages.files);

                            files.splice(imageIndex, 1);

                            const dataTransfer = new DataTransfer();

                            files.forEach(file => {
                                dataTransfer.items.add(file);
                            });

                            let fileInput = document.getElementById('{{ $id }}');

                            fileInput.files = dataTransfer.files;

                            this.uploadedFiles = Array.from(fileInput.files);

                            this.previewFiles(false);
                        },
                        clearUploaded() {
                            const srcImageForDelete   = this.$el.getAttribute('data-src');

                            const imageParent = this.$el.closest('div.input-image-multiple__preview-item');

                            imageParent.style.display = "none";

                            this.placeholder = this.placeholder-1;

                            this.$refs.imagesForDeleteStr.value = this.$refs.imagesForDeleteStr.value + srcImageForDelete + ',';
                        }
                    })
                )
            });
        </script>
    @endpush
@endonce

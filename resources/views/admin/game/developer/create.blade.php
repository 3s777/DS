<x-layouts.admin :search="false">
    <x-ui.form class="crud-form" id="create-form" action="{{ route('game-developers.store') }}">
        <section class="crud-form__main">
            <x-ui.title size="normal" indent="small">
                {{ __('game.developer.add') }}
            </x-ui.title>

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
        </section>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <div x-data="imgPreview" x-cloak>
                    <div class="input-image">
                        <div class="input-image__preview" :class="imgSrc ? 'input-image__preview_hidden' : ''">
                            <div class="input-image__placeholder" x-show="!imgSrc">
                                <div class="input-image__placeholder-text">
                                    <p>Формат jpg, png</p>
                                    <p>Максимальный размер 6Mb</p>
                                </div>
                            </div>
                            <template x-if="imgSrc">
                                <div>
                                    <x-ui.badge class="input-image__close" @click="clearFile" title="Удалить">
                                        <x-svg.close></x-svg.close>
                                    </x-ui.badge>
                                    <img :src="imgSrc" class="imgPreview">
                                </div>
                            </template>
                        </div>
                        <x-ui.form.button class="input-image__submit" tag="label" for="imgSelect">
                            {{ __('Выберите изображение') }}
                        </x-ui.form.button>
                        <input type="file" hidden id="imgSelect" accept="image/*" x-ref="myFile" @change="previewFile">
                    </div>
                </div>
            </div>
        </div>

        <div class="crud-form__submit_mobile">
            <x-ui.form.group>
                <x-ui.form.button x-bind:disabled="preventSubmit">{{ __('common.add') }}</x-ui.form.button>
            </x-ui.form.group>
        </div>
    </x-ui.form>

    @push('scripts')
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('imgPreview', () => ({
                    imgSrc:null,
                    previewFile() {
                        let file = this.$refs.myFile.files[0];
                        if(!file || file.type.indexOf('image/') === -1) {
                            this.imgSrc = null;
                            return;
                        }
                        this.imgSrc = null;
                        let reader = new FileReader();

                        reader.onload = e => {
                            this.imgSrc = e.target.result;
                        }

                        reader.readAsDataURL(file);
                    },
                    clearFile() {
                        this.imgSrc = null;
                        this.$refs.myFile.value = null;
                    }
                })
                )
            });
        </script>
    @endpush
</x-layouts.admin>

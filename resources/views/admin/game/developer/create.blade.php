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
                        <div x-data="imgPreview" x-cloak>
                            <div class="input-image">
                                <div class="input-image__preview">
                                    <div class="input-image__placeholder" x-show="!imgsrc">
                                        <div>Формат jpg, png</div>
                                        <div>Максимальный размер 6Mb</div>
                                    </div>
                                    <template x-if="imgsrc">
                                        <img :src="imgsrc" class="imgPreview">
                                    </template>
                                </div>
                                <x-ui.form.button tag="label" for="imgSelect">
                                    {{ __('Выберите изображение') }}
                                </x-ui.form.button>
                                <input type="file" hidden id="imgSelect" accept="image/*" x-ref="myFile" @change="previewFile">

                            </div>
                        </div>
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



    @push('scripts')
        <script type="module">
        </script>

        <script>
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

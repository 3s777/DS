<x-layouts.admin :search="false">
    <x-ui.form class="crud-form" method="put" id="edit-form" action="{{ route('game-developers.update', $gameDeveloper->slug) }}" enctype="multipart/form-data">
        <x-ui.title class="curd-form__tile" size="normal" indent="small">
            {{ __('game.developer.add') }}
        </x-ui.title>

        <div class="crud-form__main">
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

                <x-grid.col xl="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.rich-text-editor
                            name="description"
                            value="{!! $gameDeveloper->description !!}"
                            placeholder="{{ __('common.description') }}" />
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image
                    name="thumbnail"
                    id="thumbnail"
                    :path="$gameDeveloper->getThumbnailPath()">
                    @if($gameDeveloper->getThumbnailPath())
                    <x-slot:uploaded-thumbnail>
                        <x-ui.responsive-image
                            :model="$gameDeveloper"
                            :image-sizes="['small', 'medium', 'large']"
                            :path="$gameDeveloper->getThumbnailPath()"
                            :placeholder="false"
                            sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 220px">
                            <x-slot:img alt="test" title="test title"></x-slot:img>
                        </x-ui.responsive-image>
                    </x-slot:uploaded-thumbnail>
                    @endif
                    <p>{{ __('common.file.format') }} jpg, png</p>
                    <p>{{ __('common.file.max_size') }} 6Mb</p>
                </x-ui.form.input-image>
            </div>
        </div>

        <x-ui.form.group class="crud-form__submit">
            <x-ui.form.button x-bind:disabled="preventSubmit">{{ __('common.add') }}</x-ui.form.button>
        </x-ui.form.group>
    </x-ui.form>
</x-layouts.admin>

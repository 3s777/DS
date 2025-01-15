@props([
    'action',
    'title',
    'model' => false,
    'id' => 'create-form',
    'multipart' => 'multipart/form-data',
    'description' => true,
    'sidebar' => false,
    'featuredImage' => true,
    'images' => false,
    'buttonText' => __('common.save')
])

<x-ui.form
    {{ $attributes->class([
            'crud-form',
            'crud-form_full-width' => !$sidebar
        ])
    }}
{{--    :class="$sidebar ? 'crud-form' : 'crud-form crud-form_full-width'"--}}
    :id="($model && $id == 'create-form') ? 'edit-form' : $id"
    :method="$model ? 'put' : 'post'"
    :action="$action"
    :enctype="$multipart">
    <x-ui.title class="crud-form__tile" size="normal" indent="small">
        {{ $title }}
    </x-ui.title>

    <div class="crud-form__main">
        {{ $slot }}
    </div>

    @if($description)
        <div class="crud-form__description">
            <x-ui.form.group>
                <x-libraries.rich-text-editor
                    name="description"
                    :value="$model ? $model->description : ''"
                    :placeholder="__('common.description')"/>
            </x-ui.form.group>
        </div>
    @endif

    @if($sidebar)
        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                @if($featuredImage)
                    <div class="crud-form__sidebar-widget">
                        <x-ui.form.input-image
                            class="crud-form__input-image"
                            name="featured_image"
                            id="featured_image"
                            :path="$model ? $model->getFeaturedImagePath() : false">
                            @if($model)
                                @if($model->getFeaturedImagePath())
                                    <x-slot:uploaded-featured-image>
                                        <x-ui.responsive-image
                                            :model="$model"
                                            :image-sizes="['small', 'medium', 'large']"
                                            :path="$model->getFeaturedImagePath()"
                                            :placeholder="false"
                                            sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 220px">
                                            <x-slot:img alt="test" title="test title"></x-slot:img>
                                        </x-ui.responsive-image>
                                    </x-slot:uploaded-featured-image>
                                @endif
                            @endif
                            <p>{{ __('common.file.format') }} jpg, png</p>
                            <p>{{ __('common.file.max_size') }} 6Mb</p>
                        </x-ui.form.input-image>
                    </div>
                @endif

                @if($images)
                    <div class="crud-form__sidebar-widget">
                        <x-ui.form.input-image-multiple
                            class="crud-form__input-image-multiple"
                            name="images[]"
                            id="images"
                            :model="$model ? $model : false"
                            :image-sizes="['small', 'medium', 'large']"
                            sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 220px">
                            <p>{{ __('common.file.format') }} jpg, png</p>
                            <p>{{ __('common.file.max_size') }} 6Mb</p>
                            <p>{{ __('common.file.count', ['count' => 9]) }}</p>
                        </x-ui.form.input-image-multiple>
                    </div>
                @endif

                {{ $sidebar }}
            </div>
        </div>
    @endif

    <x-ui.form.group class="crud-form__submit">
        <x-ui.form.button
            class="crud-form__submit-button"
            x-bind:disabled="preventSubmit">
            {{ $buttonText }}
        </x-ui.form.button>
    </x-ui.form.group>
</x-ui.form>

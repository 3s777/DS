<x-layouts.admin :search="false">

    <x-ui.form class="crud-form"
               method="put"
               id="edit-form"
               action="{{ route('users.update', $user->slug) }}"
               enctype="multipart/form-data">
            <x-ui.title class="curd-form__tile" size="normal" indent="small">
                {{ __('crud.edit', ['entity' => __('entity.user_a')]) }}
            </x-ui.title>

            <div class="crud-form__main">
                <x-grid type="container">
                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :errors="$errors"
                                placeholder="{{ __('auth.username') }} *"
                                id="name"
                                name="name"
                                value="{{ $user->name }}"
                                required
                                autocomplete="on"
                                autofocus>
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :errors="$errors"
                                placeholder="{{ __('auth.first_name') }}"
                                id="first_name"
                                name="first_name"
                                value="{{ $user->first_name }}"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :errors="$errors"
                                placeholder="{{ __('common.slug') }}"
                                id="slug"
                                name="slug"
                                value="{{ $user->slug }}"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="language"
                                id="language_id"
                                name="language_id"
                                label="{{ __('common.language') }} *">
                                <x-ui.form.option value="">{{ __('common.choose_language') }}</x-ui.form.option>
                                @foreach($languages as $language)
                                    <x-ui.form.option
                                        value="{{ $language['id'] }}"
                                        :selected="$user->language_id == $language['id']"
                                    >
                                        {{ $language['name'] }}
                                    </x-ui.form.option>
                                @endforeach
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :errors="$errors"
                                type="email"
                                placeholder="{{ __('common.email') }} *"
                                id="email"
                                name="email"
                                value="{{ $user->email }}"
                                autocomplete="on">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.input-text
                                :errors="$errors"
                                placeholder="{{ __('auth.password') }} *"
                                id="password"
                                name="password">
                            </x-ui.form.input-text>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                        <x-ui.form.group>
                            <x-ui.form.switcher
                                name="is_verified"
                                value="1"
                                label="{{ __('auth.is_verified') }}"
{{--                                :checked="old() ? old('is_verified') : 'checked'"--}}
                                :checked="$user->email_verified_at"
                            >
                            </x-ui.form.switcher>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>
            </div>

            <div class="crud-form__description">
                <x-ui.form.group>
                    <x-libraries.rich-text-editor
                        name="description"
                        value="{!! $user->description !!}"
                        placeholder="{{ __('common.description') }}"/>
                </x-ui.form.group>
            </div>

            <div class="crud-form__sidebar">
                <div class="crud-form__sidebar-wrapper">
                    <x-ui.form.input-image
                        class="crud-form__input-image"
                        name="thumbnail"
                        id="thumbnail"
                        :path="$user->getThumbnailPath()">
                        @if($user->getThumbnailPath())
                            <x-slot:uploaded-thumbnail>
                                <x-ui.responsive-image
                                    :model="$user"
                                    :image-sizes="['small', 'medium', 'large']"
                                    :path="$user->getThumbnailPath()"
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
                <x-ui.form.button
                    class="crud-form__submit-button"
                    x-bind:disabled="preventSubmit">
                    {{ __('common.save') }}
                </x-ui.form.button>
            </x-ui.form.group>
        </x-ui.form>


    @push('scripts')
        <script type="module">
            const language = document.querySelector('.language');
            const choicesLanguage = new Choices(language, {
                itemSelectText: '',
                searchEnabled: false,
            });
        </script>
    @endpush
</x-layouts.admin>

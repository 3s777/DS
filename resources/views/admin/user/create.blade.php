<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               id="create-form"
               action="{{ route('users.store') }}"
               enctype="multipart/form-data">
        <x-ui.title class="curd-form__tile" size="normal" indent="small">
            {{ __('user.add') }}
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
                            value="{{ old('name') }}"
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
                            value="{{ old('first_name') }}"
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
                            value="{{ old('slug') }}"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-language"
                            id="language_id"
                            name="language_id"
                            label="{{ __('common.language') }} *">
                            @foreach($languages as $language)
                                <x-ui.form.option
                                    value="{{ $language['id'] }}"
                                    :selected="old('language_id') == $language['id']"
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
                            value="{{ old('email') }}"
                            required
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
                            name="password"
                            required>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.switcher
                            name="is_verified"
                            value="1"
                            label="{{ __('auth.is_verified') }}"
                            :checked="old() ? old('is_verified') : 'checked'"
                        >
                        </x-ui.form.switcher>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-libraries.choices
                            class="choices-role"
                            id="roles"
                            name="roles[]"
                            label="{{ __('role.choose') }}"
                            multiple>
                            @foreach($roles as $role)
                                <x-ui.form.option value="{{ $role['name'] }}"
                                    :selected="$role['name'] == config('settings.default_role')"
                                >
                                    {{ $role['display_name'] }}
                                </x-ui.form.option>
                            @endforeach
                        </x-libraries.choices>
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        </div>

        <div class="crud-form__description">
            <x-ui.form.group>
                <x-libraries.rich-text-editor
                    name="description"
                    value=""
                    placeholder="{{ __('common.description') }}"/>
            </x-ui.form.group>
        </div>

        <div class="crud-form__sidebar">
            <div class="crud-form__sidebar-wrapper">
                <x-ui.form.input-image
                    class="crud-form__input-image"
                    name="thumbnail"
                    id="thumbnail">
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
        const language = document.querySelector('.choices-language');
        const choicesLanguage = new Choices(language, {
            itemSelectText: '',
            searchEnabled: false,
        });
        const role = document.querySelector('.choices-role');
        const choicesRole = new Choices(role, {
            itemSelectText: '',
            removeItems: true,
            removeItemButton: true,
            noResultsText: '{{ __('common.not_found') }}',
            noChoicesText: '{{ __('common.nothing_else') }}',
        });
    </script>
@endpush
</x-layouts.admin>

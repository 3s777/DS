<x-layouts.admin :search="false">

    <x-ui.form class="crud-form"
               method="put"
               id="edit-form"
               action="{{ route('users.update', $user->slug) }}"
               enctype="multipart/form-data">
            <x-ui.title class="curd-form__tile" size="normal" indent="small">
                {{ __('user.edit') }}
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
                                :checked="$user->email_verified_at">
                            </x-ui.form.switcher>
                        </x-ui.form.group>
                    </x-grid.col>

                    <x-grid.col xl="12" lg="12" md="12" sm="12">
                        <x-ui.form.group>
                            <x-libraries.choices
                                class="choices-role"
                                id="roles"
                                name="roles[]"
                                label="{{ __('role.choose') }}" multiple>
                                @foreach($roles as $role)
                                    <x-ui.form.option value="{{ $role['name'] }}"
                                    :selected="old()
                                        ? in_array($role['name'], old('roles', []))
                                        : $user->hasRole([$role['name']])">
                                        {{ $role['display_name'] }}
                                    </x-ui.form.option>
                                @endforeach
                            </x-libraries.choices>
                        </x-ui.form.group>
                    </x-grid.col>
                </x-grid>

                <x-ui.form.group>
                    <x-ui.accordion>
                        <x-ui.accordion.item  padding="none" color="light">
                            <x-ui.accordion.title>{{ __('permission.additional') }}</x-ui.accordion.title>
                            <x-ui.accordion.content>
                                <x-grid type="container">
                                    @foreach($permissions as $key => $permission)
                                        <x-grid.col xl="3" ls="6" ml="12" lg="6" md="6" sm="12">
                                            <x-ui.form.group size="small">
                                                <x-ui.form.input-checkbox
                                                    id="permission-{{ $key }}"
                                                    name="permissions[]"
                                                    value="{{ $permission['name'] }}"
                                                    label="{{ $permission['display_name'] }}"
                                                    :disabled="in_array($permission['name'], $rolePermissions)"
                                                    :checked="old()
                                                        ? in_array($permission['name'], old('permissions', []))
                                                        : $user->hasPermissionTo($permission['name'])">
                                                </x-ui.form.input-checkbox>
                                            </x-ui.form.group>
                                        </x-grid.col>
                                    @endforeach
                                </x-grid>
                            </x-ui.accordion.content>
                        </x-ui.accordion.item>
                    </x-ui.accordion>
                </x-ui.form.group>
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

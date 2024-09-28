<x-layouts.admin :search="false">
    <x-ui.form class="crud-form"
               id="create-form"
               :action="route('users.store')"
               enctype="multipart/form-data">
        <x-ui.title class="crud-form__tile" size="normal" indent="small">
            {{ __('user.add') }}
        </x-ui.title>

        <div class="crud-form__main">
            <x-grid type="container">
                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('auth.username')"
                            id="name"
                            name="name"
                            :value="old('name')"
                            required
                            autocomplete="on"
                            autofocus>
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('auth.first_name')"
                            id="first_name"
                            name="first_name"
                            :value="old('first_name')"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('common.slug')"
                            id="slug"
                            name="slug"
                            :value="old('slug')"
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data
                            name="language"
                            select-name="language_id"
                            :options="$languages"
                            :label="__('common.language')"
                        />
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            type="email"
                            :placeholder="__('common.email')"
                            id="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="on">
                        </x-ui.form.input-text>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="4" ls="6" ml="12" lg="6" md="6" sm="12">
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :placeholder="__('auth.password')"
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
                            :value="1"
                            :label="__('auth.is_verified')"
                            :checked="old() ? old('is_verified') : 'checked'">
                        </x-ui.form.switcher>
                    </x-ui.form.group>
                </x-grid.col>

                <x-grid.col xl="12" lg="12" md="12" sm="12">
                    <x-ui.form.group>
                        <x-ui.select.data-multiple
                            name="roles"
                            select-name="roles[]"
                            type="input"
                            :selected="[config('settings.default_role')]"
                            :options="$roles"
                            :label="trans_choice('role.choose', 1)"
                            :required="true"
                        />
                    </x-ui.form.group>
                </x-grid.col>
            </x-grid>
        </div>

        <div class="crud-form__description">
            <x-ui.form.group>
                <x-libraries.rich-text-editor
                    name="description"
                    value=""
                    :placeholder="__('common.description')"/>
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
</x-layouts.admin>

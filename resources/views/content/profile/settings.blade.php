<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="profile-settings">
            <x-slot:sidebar>
                @include('content.profile.menu')
            </x-slot:sidebar>
            <x-ui.title indent="normal">{{ __('user.profile.settings') }}</x-ui.title>

            <x-common.messages class="profile-settings__messages" />

            <x-ui.form
                class="profile-settings__form"
                :action="route('profile.settings.update')"
                method="put"
                enctype="multipart/form-data">
                <div class="profile-settings__main">
                    <div class="profile-settings__avatar">
                        <x-ui.form.input-image
                            class="profile-settings__input-image"
                            name="featured_image"
                            id="featured_image"
                            :path="auth('collector')->user()->getFeaturedImagePath()">

                            @if(auth('collector')->user()->getFeaturedImagePath())
                                <x-slot:uploaded-featured-image>
                                    <x-ui.responsive-image
                                        :model="auth('collector')->user()"
                                        :image-sizes="['small', 'medium', 'large']"
                                        :path="auth('collector')->user()->getFeaturedImagePath()"
                                        :placeholder="false"
                                        sizes="(max-width: 1024px) 100vw, (max-width: 1400px) 30vw, 220px">
                                        <x-slot:img alt="test" title="test title"></x-slot:img>
                                    </x-ui.responsive-image>
                                </x-slot:uploaded-featured-image>
                            @endif

                            <p>{{ __('common.file.format') }} jpg, png</p>
                            <p>{{ __('common.file.max_size') }} 6Mb</p>
                        </x-ui.form.input-image>
                    </div>

                    <div class="profile-settings__info">
                            <div class="profile-settings__info-field">
                                <x-ui.form.input-text
                                    name="username"
                                    id="username"
                                    :placeholder="__('auth.username')"
                                    :value="auth('collector')->user()->name"
                                    disabled>
                                </x-ui.form.input-text>
                            </div>

                            <div class="profile-settings__info-field">
                                <x-ui.form.input-text
                                    :placeholder="__('auth.first_name')"
                                    id="first_name"
                                    name="first_name"
                                    :value="auth('collector')->user()->first_name"
                                    autocomplete="on">
                                </x-ui.form.input-text>
                            </div>

                            <div class="profile-settings__info-field">
                                <x-ui.form.input-text
                                    type="email"
                                    :placeholder="__('common.email')"
                                    id="email"
                                    name="email"
                                    :value="auth('collector')->user()->email"
                                    disabled>
                                </x-ui.form.input-text>
                            </div>

                            <div class="profile-settings__info-field">
                                <x-ui.select.enum
                                    name="language"
                                    select-name="language"
                                    :selected="auth('collector')->user()->language"
                                    :options="$languages"
                                    :label="__('common.language')"
                                />
                            </div>

                            <div class="profile-settings__description">
                                <x-libraries.rich-text-editor
                                    name="description"
                                    :value="auth('collector')->user()->description"
                                    :placeholder="__('common.description')"/>
                            </div>
                    </div>
                </div>

                <div class="profile-settings__password">
                    <x-ui.title indent="normal">{{ __('auth.change_password') }}</x-ui.title>

                    <div class="profile-settings__password-inner">
                        <div class="profile-settings__password-field">
                            <x-ui.form.input-text
                                id="current_password"
                                name="current_password"
                                type="password"
                                value=""
                                placeholder="{{ __('auth.current_password') }}">
                            </x-ui.form.input-text>
                        </div>
                        <div class="profile-settings__password-field">
                            <x-ui.form.input-text
                                id="new_password"
                                name="new_password"
                                type="password"
                                value=""
                                placeholder="{{ __('auth.new_password') }}">
                            </x-ui.form.input-text>
                        </div>
                        <div class="profile-settings__password-field">
                            <x-ui.form.input-text
                                id="new_password_confirmation"
                                name="new_password_confirmation"
                                type="password"
                                value=""
                                placeholder="{{ __('auth.confirm_new_password') }}">
                            </x-ui.form.input-text>
                        </div>
                    </div>
                </div>

                <div class="profile-settings__other">
                    <x-ui.title indent="normal">{{ __('common.other_settings') }}</x-ui.title>
                    <div class="profile-settings__other-field">
                        <div class="profile-settings__other-inner">
                            <x-ui.title tag="div" size="small" indent="normal">
                                {{ __('common.choose_theme_color') }}
                            </x-ui.title>
                            <x-common.theme-switcher class="profile-settings__theme-switcher" />
                        </div>
                    </div>
                </div>

                <div class="profile-settings__submit">
                    <x-ui.form.button
                        class="profile-settings__submit-button"
                        x-bind:disabled="preventSubmit">
                        {{ __('common.save_settings') }}
                    </x-ui.form.button>
                </div>

            </x-ui.form>
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

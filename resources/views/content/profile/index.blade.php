<x-layouts.main title="{{ __('Users') }}" :search="false">
    <x-grid.container>
        <x-common.content class="profile-settings">
            <x-slot:sidebar>
                @include('content.profile.menu')
            </x-slot:sidebar>
            <x-ui.title indent="normal">{{ __('user.profile.settings') }}</x-ui.title>
            <x-ui.form class="profile__settings" :action="route('profile.settings')">
                <div class="profile-settings__main">
                    <div class="profile-settings__avatar">
                        <x-ui.form.input-image
                            class="profile-settings__input-image"
                            name="featured_image"
                            id="featured_image"
                            :path="auth('collector')->user()->getFeaturedImagePath() ">

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

                            <div class="profile-settings__description">
                                <x-libraries.rich-text-editor
                                    name="description"
                                    :value="auth('collector')->user()->description"
                                    :placeholder="__('common.description')"/>
                            </div>
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
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

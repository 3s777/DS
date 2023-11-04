<x-layouts.main title="Register">
    <x-grid.container>
        <div class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('Register') }}
                    </x-ui.title>
                </x-slot>

                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="{{ __('Name') }}"
                            required
                            autofocus
                            autocomplete="name">
                        </x-ui.form.input-text>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('E-Mail Address') }}"
                            required
                            autofocus
                            autocomplete="email">
                        </x-ui.form.input-text>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            id="password"
                            name="password"
                            type="password"
                            value=""
                            placeholder="{{ __('Password') }}"
                            required
                            autofocus
                            autocomplete="new-password">
                        </x-ui.form.input-text>

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            id="password-confirm"
                            name="password_confirmation"
                            type="password"
                            value=""
                            placeholder="{{ __('Confirm Password') }}"
                            required
                            autofocus
                            autocomplete="new-password">
                        </x-ui.form.input-text>

                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.button full_width="true">
                            {{ __('Register') }}
                        </x-ui.form.button>
                    </x-ui.form.group>
                </form>
            </x-ui.card>
        </div>
    </x-grid.container>
</x-layouts.main>

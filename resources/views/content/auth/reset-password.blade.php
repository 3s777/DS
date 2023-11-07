<x-layouts.main title="Reset Password">
    <x-grid.container>
        <div class="auth__content">
            <x-ui.card>
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('Reset Password') }}
                    </x-ui.title>
                </x-slot>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->route('token') }}">

                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('Email') }}"
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

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </x-ui.form.group>

                    <x-ui.from.group>
                        <x-ui.form.button full-width="true">
                            {{ __('Reset Password') }}
                        </x-ui.form.button>
                    </x-ui.from.group>
                </form>
            </x-ui.card>
        </div>
    </x-grid.container>
</x-layouts.main>

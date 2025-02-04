<x-layouts.main title="{{ __('auth.login') }}" :search="false">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('auth.login') }}
                    </x-ui.title>
                </x-slot>

                <x-common.messages class="auth__message" />

                <form class="form" method="POST" action="{{ route('admin.login.handle') }}">
                    @csrf
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            placeholder="{{ __('auth.email') }}"
                            required
                            autofocus
                            autocomplete="email">
                        </x-ui.form.input-text>
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.input-text
                            id="password"
                            name="password"
                            type="password"
                            value=""
                            placeholder="{{ __('auth.password') }}"
                            required
                            autofocus
                            autocomplete="current-password">
                        </x-ui.form.input-text>
                    </x-ui.form.group>

                    <x-ui.form.group size="small">
                        <x-ui.form.input-checkbox
                            id="remember"
                            name="remember"
                            label="{{ __('auth.remember') }}"
                        >
                        </x-ui.form.input-checkbox>
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.button full-width="true">
                            {{ __('auth.login') }}
                        </x-ui.form.button>

                        @if (Route::has('forgot'))
                            <div class="auth__forgot">
                                <a class="auth__forgot-link" href="{{ route('forgot') }}">
                                    {{ __('auth.forgot_question') }}
                                </a>
                            </div>
                        @endif
                    </x-ui.form.group>
                </form>
            </x-ui.card>
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

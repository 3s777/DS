<x-layouts.main title="{{ __('Forgot Password') }}">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('Reset Password') }}
                    </x-ui.title>
                </x-slot>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                @if ($errors->any())
                    <x-ui.message class="auth__message" type="danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </x-ui.message>
                @endif

                <form class="form" method="POST" action="{{ route('password.email') }}">
                    @csrf
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
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.button full-width="true">
                            {{ __('Send Password Reset Link') }}
                        </x-ui.form.button>
                    </x-ui.form.group>
                </form>
            </x-ui.card>
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

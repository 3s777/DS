<x-layouts.main title="Login">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('Login') }}
                    </x-ui.title>
                </x-slot>

                @if ($errors->any())
                    <x-ui.message class="auth__message" type="danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </x-ui.message>
                @endif

                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <x-ui.form.group>
                        <x-ui.form.input-text
                            :errors="$errors"
                            id="username"
                            name="username"
                            type="text"
                            value="{{ old('username') }}"
                            placeholder="{{ __('Username or email') }}"
                            required
                            autofocus
                            autocomplete="username">
                        </x-ui.form.input-text>
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
                            autocomplete="current-password">
                        </x-ui.form.input-text>
                    </x-ui.form.group>

                    <x-ui.form.group size="small">
                        <x-ui.form.input-checkbox
                            id="remember"
                            name="remember"
                            label="{{ __('Remember Me') }}"
                        >
                        </x-ui.form.input-checkbox>
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.button full-width="true">
                            {{ __('Login') }}
                        </x-ui.form.button>

                        @if (Route::has('password.request'))
                            <div class="auth__forgot">
                                <a class="auth__forgot-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        @endif
                    </x-ui.form.group>
                </form>
            </x-ui.card>
        </x-common.content>
    </x-grid.container>
    @push('scripts')
        <script type="module">
            var selects = document.getElementsByClassName("choices-select-auto");
            for (var i = 0; i < selects.length; i++) {

                new Choices(selects.item(i), {
                    itemSelectText: '',
                    searchEnabled: false,
                    shouldSort: false,
                    allowHTML: true,
                    noResultsText: '{{ __('Не найдено') }}',
                    noChoicesText: '{{ __('Больше ничего нет') }}',
                });
            }
        </script>
    @endpush
</x-layouts.main>

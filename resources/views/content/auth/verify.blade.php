<x-layouts.auth title="{{ __('auth.login') }}">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('Verify your Email') }}
                    </x-ui.title>
                </x-slot>

                    <x-common.messages />

                    <x-ui.form.group>
                        <x-ui.message type="info">
                            <p>{{ __('You need verify your Email') }}</p>
                            <p>{{ __('Если вы не получили письмо, запросите письмо еще раз, заполнив форму ниже') }}</p>
                        </x-ui.message>
                    </x-ui.form.group>

                    <form action="{{ route('verification.send') }}" method="POST">
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
                                autocomplete="email">
                            </x-ui.form.input-text>
                        </x-ui.form.group>

                        <x-ui.form.group>
                            <x-ui.form.button full-width="true">Отправить письмо повторно</x-ui.form.button>
                        </x-ui.form.group>
                    </form>

            </x-ui.card>
        </x-common.content>
    </x-grid.container>
</x-layouts.auth>

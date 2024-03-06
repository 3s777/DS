<x-layouts.main title="{{ __('auth.verify') }}" :search="false">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('auth.verify') }}
                    </x-ui.title>
                </x-slot>

                    <x-common.messages class="auth__message" />

                    <x-ui.form.group>
                        <x-ui.message type="info">
                            <p>{{ __('auth.verify_title') }}</p>
                            <p>{{ __('auth.verify_message') }}</p>
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
                                placeholder="{{ __('auth.email') }}"
                                required
                                autocomplete="email">
                            </x-ui.form.input-text>
                        </x-ui.form.group>

                        <x-ui.form.group>
                            <x-ui.form.button full-width="true">{{ __('auth.verify_retry') }}</x-ui.form.button>
                        </x-ui.form.group>
                    </form>

            </x-ui.card>
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

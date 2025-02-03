<x-layouts.main title="{{ __('auth.forgot') }}" :search="false">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('auth.reset') }}
                    </x-ui.title>
                </x-slot>

                    <x-common.messages class="auth__message" />

                <form class="form" method="POST" action="{{ route('admin.forgot.handle') }}">
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
                        <x-ui.form.button full-width="true">
                            {{ __('auth.reset_button') }}
                        </x-ui.form.button>
                    </x-ui.form.group>
                </form>
            </x-ui.card>
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

<x-layouts.main title="{{ __('auth.register') }}" :search="false">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('auth.register') }}
                    </x-ui.title>
                </x-slot>

                <x-common.messages class="auth__message" />

                <form class="form" method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <x-ui.form.group type="flex">
                        <x-ui.form.input-text

                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="{{ __('auth.username') }}"
                            required
                            autofocus
                            autocomplete="name">
                        </x-ui.form.input-text>

{{--                        <input type="hidden" name="language_id" value="oo">--}}

                        <x-ui.form.button
                            class="tooltip_trigger"
                            type="button"
                            color="info"
                            tooltip="true"
                            data-tooltip="tooltip_1">
                            ?
                        </x-ui.form.button>

                        <x-ui.tooltip
                            class="tooltip_1"
                            id="tooltip">
                            {{ __('auth.username_tooltip') }}
                        </x-ui.tooltip>
                    </x-ui.form.group>

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
                            autocomplete="new-password">
                        </x-ui.form.input-text>
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.input-text

                            id="password-confirm"
                            name="password_confirmation"
                            type="password"
                            value=""
                            placeholder="{{ __('auth.password_confirm') }}"
                            required
                            autofocus
                            autocomplete="new-password">
                        </x-ui.form.input-text>
                    </x-ui.form.group>

                    <x-ui.form.group>
                        <x-ui.form.button full-width="true">
                            {{ __('auth.register') }}
                        </x-ui.form.button>
                    </x-ui.form.group>
                </form>
            </x-ui.card>
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

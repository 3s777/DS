<x-layouts.main title="Register">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('Register') }}
                    </x-ui.title>
                </x-slot>

                <x-common.messages />

                <form class="form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <x-ui.form.group type="flex">
                        <x-ui.form.input-text
                            :errors="$errors"
                            id="name"
                            name="name"
                            type="text"
                            value="{{ old('name') }}"
                            placeholder="{{ __('Username') }}"
                            required
                            autofocus
                            autocomplete="name">
                        </x-ui.form.input-text>

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
                            Имя пользователя должно быть в нижнем регистре, латиницей, может содержать цифры и знак "."
                        </x-ui.tooltip>
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
                        <x-ui.form.button full-width="true">
                            {{ __('Register') }}
                        </x-ui.form.button>
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

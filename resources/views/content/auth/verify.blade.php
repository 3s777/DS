<x-layouts.main title="Login">
    <x-grid.container>
        <x-common.content class="auth__content">
            <x-ui.card class="auth__card">
                <x-slot:header>
                    <x-ui.title tag="h1">
                        {{ __('Verify your Email') }}
                    </x-ui.title>
                </x-slot>

                @if (session('status'))
                    <x-ui.message class="auth__message" type="info">
                        {{ session('status') }}
                    </x-ui.message>
                @endif

                @if ($errors->any())
                    <x-ui.message class="auth__message" type="danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </x-ui.message>
                @endif

                Подтвердите Ваш эмейл
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

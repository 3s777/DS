@props([
    'title' => '',
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-common.meta />

        @vite(['resources/scss/admin.scss'])
    </head>
    <body>
        <x-common.header />

        <main class="main">
            <x-grid.container>
                <x-common.content
                    {{ $attributes->class([
                            'admin'
                        ])
                    }}
                    wrapper-class="admin__content">
                    <x-slot:sidebar>
                        <x-common.sidebar-menu class="admin__menu" />
                    </x-slot:sidebar>

                    <x-common.messages class="admin__messages" />

                    {{ $slot }}

                </x-common.content>
            </x-grid.container>
        </main>

        <x-common.footer />

        @vite(['resources/js/app.js'])

        @stack('scripts')

    </body>
</html>

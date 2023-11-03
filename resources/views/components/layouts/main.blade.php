@props([
    'title' => '',
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-common.meta />

        @vite(['resources/scss/app.scss'])
    </head>
    <body>
        <x-common.header />

        <main class="main">
            {{ $slot }}
        </main>

        <x-common.footer />

        @vite(['resources/js/app.js'])

        @stack('scripts')
    </body>
</html>

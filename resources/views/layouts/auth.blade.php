<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('common.meta')

        @vite(['resources/scss/app.scss'])
    </head>
    <body>
        <div class="auth">
            @include('common.header')


            <main class="main">
                @yield('content')
            </main>

            @include('common.footer')
        </div>

        @vite(['resources/js/app.js'])
        @stack('scripts')
    </body>
</html>

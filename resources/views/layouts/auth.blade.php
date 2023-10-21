<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('common.meta')

        @vite(['resources/scss/app.scss'])
        @vite(['resources/js/app.js'])
    </head>
    <body>
        <div class="auth">
            @include('common.header')


            <main class="main">
                @yield('content')
            </main>

            @include('common.footer')
        </div>


        @stack('scripts')
    </body>
</html>

@props([
    'title' => '',
    'search' => true,
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-common.meta />

        @vite(['resources/scss/app.scss'])

    </head>
    <body class="body {{ session()->get('color.theme') }}">
        <x-common.header />

        <main class="main">
            {{ $slot }}
        </main>

        <x-common.footer />

        @vite(['resources/js/app.js'])

        @stack('scripts')

        <script type="module">
            Fancybox.defaults.l10n = {
                CLOSE: "{{ __('fancybox.close') }}",
                NEXT: "{{ __('fancybox.next') }}",
                PREV: "{{ __('fancybox.prev') }}",
                MODAL: "{{ __('fancybox.modal') }}",
                ERROR: "{{ __('fancybox.error') }}",
                IMAGE_ERROR: "{{ __('fancybox.image_error') }}",
                ELEMENT_NOT_FOUND: "{{ __('fancybox.element_not_found') }}",
                AJAX_NOT_FOUND: "{{ __('fancybox.ajax_not_found') }}",
                AJAX_FORBIDDEN: "{{ __('fancybox.ajax_forbidden') }}",
                IFRAME_ERROR: "{{ __('fancybox.iframe_error') }}",
                TOGGLE_ZOOM: "{{ __('fancybox.toggle_zoom') }}",
                TOGGLE_THUMBS: "{{ __('fancybox.toggle_thumbs') }}",
                TOGGLE_SLIDESHOW: "{{ __('fancybox.toggle_slideshow') }}",
                TOGGLE_FULLSCREEN: "{{ __('fancybox.toggle_fullscreen') }}",
                DOWNLOAD: "{{ __('fancybox.download') }}",
                ITERATEZOOM: "{{ __('fancybox.iteratezoom') }}",
            }

            Fancybox.bind("[data-fancybox]", {});
        </script>
    </body>
</html>

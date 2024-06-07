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

        <main class="main" x-data="{collapseSidebar: $persist(false)}">
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
        @vite(['resources/js/scripts.js'])
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

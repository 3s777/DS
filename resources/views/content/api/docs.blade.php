<x-layouts.main title="Api Documentation v1" :search="false">
    <x-grid.container>
        <x-ui.title indent="normal">
            Api Documentation v1
        </x-ui.title>
        <div class="swagger" id="docs"></div>
    </x-grid.container>

    @push('scripts')
{{--        <link rel="stylesheet" href="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui.css" />--}}
{{--        <script src="https://unpkg.com/swagger-ui-dist@5.11.0/swagger-ui-bundle.js" crossorigin></script>--}}

        @vite(['resources/js/swagger.js'])

        <script type="module">
            SwaggerUI({
                url: '{{ route('openapi.v1.yaml') }}',
                dom_id: '#docs'
            })

            {{--    window.onload = () => {--}}
            {{--    window.ui = SwaggerUIBundle({--}}
            {{--        url: '{{ route('openapi.v1.yaml') }}',--}}
            {{--        dom_id: '#docs',--}}
            {{--    });--}}
            {{--};--}}
        </script>
    @endpush
</x-layouts.main>

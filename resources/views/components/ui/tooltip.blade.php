@props([
    'id' => false,
])

<div
    {{ $attributes->class([
            'tooltip',
        ])
        ->merge([
            'role' => 'tooltip',
            'id' => $id,
            'style' => 'display:none;'
        ])
    }}>
    {{ $slot }}
</div>

@pushonce('scripts')
    <script type="module">
        tippy('[data-tippy-content]', {
            theme: 'light',
            trigger: 'click'
        });
    </script>
@endpushonce

@props([
    'status' => 'open'
])

<div
    {{ $attributes->class([
            'comments',
        ])
    }}>
    {{ $slot }}
</div>

@props([
    'active' => false
])

<div
    {{ $attributes->class([
            'tabs__content-block',
            'tabs__content-block_active' => $active,
        ])
    }}>
    {{ $slot }}
</div>

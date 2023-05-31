@props([
    'align' => 'right',
])

<div
    {{ $attributes->class([
            'popover__buttons',
            'popover__buttons_'.$align => $align,
        ])
    }}>
    {{ $slot }}
</div>

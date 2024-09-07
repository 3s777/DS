@props([
    'alignButtons' => false
])

<div
    {{ $attributes->class([
            'modal__footer',
            'modal__footer_buttons_'.$alignButtons => $alignButtons
        ])
    }}>
    {{ $slot }}
</div>

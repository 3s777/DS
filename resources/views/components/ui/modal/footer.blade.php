@props([
    'align_buttons' => false
])

<div
    {{ $attributes->class([
            'modal__footer',
            'modal__footer_buttons_'.$align_buttons => $align_buttons
        ])
    }}>
    {{ $slot }}
</div>

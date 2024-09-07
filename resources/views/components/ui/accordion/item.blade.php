@props([
    'color' => false,
    'padding' => false,
    'open' => false
])

<details
    {{ $attributes->class([
            'accordion__item',
            'accordion__item_color_'.$color => $color,
            'accordion__item_padding_'.$padding => $padding
        ])
        ->merge([
            'open' => $open
        ])
    }}>
    {{ $slot }}
</details>

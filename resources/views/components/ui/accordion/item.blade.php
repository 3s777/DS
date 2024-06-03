@props([
    'color' => false,
    'padding' => false
])

<details
    {{ $attributes->class([
            'accordion__item',
            'accordion__item_color_'.$color => $color,
            'accordion__item_padding_'.$padding => $padding
        ])
    }}>
    {{ $slot }}
</details>

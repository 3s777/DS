@props([
    'color' => false
])

<details
    {{ $attributes->class([
            'accordion__item',
            'accordion__item_color_'.$color => $color,
        ])
    }}>
    {{ $slot }}
</details>

@props([
    'tag' => 'a',
    'standard' => true,
    'indent' => 'right',
    'bottom_indent' => false,
    'color' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'tag',
            'tag_standard' => $standard,
            'tag_color_'.$color => $color,
        ])
    }}>
    {{ $slot }}
</{{ $tag }}>

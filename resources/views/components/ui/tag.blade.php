@props([
    'tag' => 'a',
    'standard' => true,
    'indent' => 'right',
    'color' => false,
    'disabled' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'tag',
            'tag_standard' => $standard,
            'tag_color_'.$color => $color,
            'tag_disabled' => $disabled
        ])
    }}>
    {{ $slot }}
</{{ $tag }}>

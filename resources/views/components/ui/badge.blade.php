@props([
    'size' => false,
    'type' => 'standard',
    'color' => false,
    'align' => false,
    'ribbon_align' => false,
    'bookmark_align' => false,
])

<div
    {{ $attributes->class([
            'badge',
            'badge_'.$type,
            'badge_standard_size_'.$size => $size,
            'badge_color_'.$color => $color,
            'badge_align_'.$align => $align,
            'badge_ribbon_align_'.$ribbon_align => $ribbon_align,
            'badge_bookmark_align_'.$bookmark_align => $bookmark_align,
        ])
    }}>
    {{ $slot }}
</div>

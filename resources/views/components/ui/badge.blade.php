@props([
    'size' => false,
    'type' => 'standard',
    'color' => false,
    'align' => false,
    'ribbonAlign' => false,
    'bookmarkAlign' => false,
    'inline' => false,
])

<div
    {{ $attributes->class([
            'badge',
            'badge_'.$type,
            'badge_standard_size_'.$size => $size,
            'badge_color_'.$color => $color,
            'badge_align_'.$align => $align,
            'badge_ribbon_align_'.$ribbonAlign => $ribbonAlign,
            'badge_bookmark_align_'.$bookmarkAlign => $bookmarkAlign,
            'badge_inline' => $inline
        ])
    }}>
    {{ $slot }}
</div>

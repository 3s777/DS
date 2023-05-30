@props([
    'tag' => 'button',
    'link' => false,
    'icon' => false,
    'icon_size' => false,
    'type' => false,
    'size' => '',
    'color' => 'submit',
    'full_width' => false,
    'only_icon' => false,
    'only_icon_size' => false,
    'tooltip' => false,
    'tooltip_size' => false,
])

<{{ $tag }}
    {{ $attributes->class([
            'button',
            'button_'.$color => $color,
            'button_size_'.$size => $size,
            'button_'.$icon_size.'_icon' => $icon_size,
            'button_full_width' => $full_width,
            'button_icon' => $icon,
            'button_only_icon' => $only_icon,
            'button_only_icon_'.$only_icon_size => $only_icon_size,
            'button_tooltip' => $tooltip,
            'button_tooltip_'.$tooltip_size => $tooltip_size,
        ])
        ->merge([
            'href' => $link,
            'type' => $type,
        ])
    }}
    {{ $color == 'disabled' ? 'disabled' : '' }} >

    @if($icon)
        <div {{ $icon->attributes->class([
                'button__icon-wrapper'
            ]) }}>
            {{ $icon }}
        </div>
    @endif

    {{ $slot }}

</{{ $tag }}>

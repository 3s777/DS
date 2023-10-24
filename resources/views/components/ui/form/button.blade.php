@props([
    'tag' => 'button',
    'link' => false,
    'icon' => false,
    'mobile_icon' => false,
    'icon_size' => false,
    'type' => false,
    'size' => '',
    'not_clickable' => false,
    'color' => 'submit',
    'full_width' => false,
    'only_icon' => false,
    'tooltip' => false,
    'tooltip_size' => false,
    'indent' => false,
    'badge' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'button',
            'button_'.$color => $color,
            'button_size_'.$size => $size,
            'button_'.$icon_size.'_icon' => $icon_size,
            'button_full_width' => $full_width,
            'button_icon' => $icon && !$mobile_icon,
            'button_icon_mobile' => $mobile_icon,
            'button_only_icon' => $only_icon,
            'button_only_icon_'.$size => $only_icon && $size,
            'button_tooltip' => $tooltip,
            'button_tooltip_'.$tooltip_size => $tooltip_size,
            'button_indent_'.$indent => $indent,
            'button_not_clickable' => $not_clickable
        ])
        ->merge([
            'href' => $link,
            'type' => $type,
        ])
    }}
    {{ $color == 'disabled' ? 'disabled' : '' }} >

    @if($icon)
        <div {{ $icon->attributes->class([
                'button__icon-wrapper',
                'button__icon-mobile-wrapper' => $mobile_icon,
            ]) }}>
            {{ $icon }}
        </div>
    @endif

    @if($mobile_icon)
        <span class="button__icon-mobile-text-wrapper">
            {{ $slot }}
        </span>
    @else
        {{ $slot }}
    @endif

    @if($badge)
        {{ $badge }}
    @endif
</{{ $tag }}>

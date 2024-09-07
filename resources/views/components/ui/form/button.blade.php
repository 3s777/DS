@props([
    'tag' => 'button',
    'link' => false,
    'icon' => false,
    'mobileIcon' => false,
    'iconSize' => false,
    'type' => false,
    'size' => '',
    'notClickable' => false,
    'color' => 'submit',
    'fullWidth' => false,
    'onlyIcon' => false,
    'tooltip' => false,
    'tooltipSize' => false,
    'indent' => false,
    'badge' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'button',
            'button_'.$color => $color,
            'button_size_'.$size => $size,
            'button_'.$iconSize.'_icon' => $iconSize,
            'button_full_width' => $fullWidth,
            'button_icon' => $icon && !$mobileIcon,
            'button_icon_mobile' => $mobileIcon,
            'button_only_icon' => $onlyIcon,
            'button_only_icon_'.$size => $onlyIcon && $size,
            'button_tooltip' => $tooltip,
            'button_tooltip_'.$tooltipSize => $tooltipSize,
            'button_indent_'.$indent => $indent,
            'button_not_clickable' => $notClickable
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
                'button__icon-mobile-wrapper' => $mobileIcon,
            ]) }}>
            {{ $icon }}
        </div>
    @endif

    @if($mobileIcon)
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

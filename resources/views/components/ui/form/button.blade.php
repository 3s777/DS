@props([
    'tag' => 'button',
    'icon' => false,
    'type' => false,
    'size' => '',
    'color' => 'submit',
    'full_width' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'button',
            'button_'.$color => $color,
            'button_'.$size => $size,
            'button_full_width' => $full_width,
            'button_icon' => $icon
        ])
        ->merge([
            'type' => $type
        ]) }}
>
    @if($icon)
        <div {{ $icon->attributes->class(['button__icon-wrapper']) }}>
            {{ $icon }}
        </div>
    @endif
    {{ $slot }}
</{{ $tag }}>

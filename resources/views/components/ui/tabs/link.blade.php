@props([
    'button' => false,
    'color' => false,
    'active' => false
])

<li
    {{ $attributes->class([
            'tabs__header-link',
            'tabs__header-link_button button' => $button,
            'tabs__header-link_active' => $active,
            'button_'.$color => $color
        ])
    }}>
    {{ $slot }}
</li>

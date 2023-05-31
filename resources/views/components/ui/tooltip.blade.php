@props([
    'id' => false,
    'arrow' => true
])

<div
    {{ $attributes->class([
            'tooltip',
        ])
        ->merge([
            'role' => 'tooltip',
            'id' => $id,
            'style' => 'display:none;'
        ])
    }}>
    {{ $slot }}
    @if($arrow)
        <div id="arrow" class="tooltip__arrow"></div>
    @endif
</div>

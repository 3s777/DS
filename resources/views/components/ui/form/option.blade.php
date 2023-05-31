@props([
    'value' => ''
])

<option
    {{ $attributes->class([
            'option',
        ])
        ->merge([
            'value' => $value,
        ])
    }}>
    {{ $slot }}
</option>

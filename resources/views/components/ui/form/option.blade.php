@props([
    'selected' => false,
    'value' => false,
])

<option
    {{ $attributes->class([
            'option',
        ])
        ->merge([
            'value' => $value,
            'selected' => $selected
            ])
    }}>
    {{ $slot }}
</option>

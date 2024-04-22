@props([
    'selected' => false
])

<option
    {{ $attributes->class([
            'option',
        ])
        ->merge([
            'selected' => $selected
            ])
    }}>
    {{ $slot }}
</option>

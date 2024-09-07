@props([
    'size' => false,
    'type' => false
])

<div
    {{ $attributes->class([
            'form-group',
            'form-group_size_'.$size => $size,
            'form-group_type_'.$type => $type
        ])
    }}>
    {{ $slot }}
</div>

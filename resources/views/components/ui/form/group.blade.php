@props([
    'size' => false
])

<div
    {{ $attributes->class([
            'form-group',
            'form-group_size_'.$size => $size
        ])
    }}>
    {{ $slot }}
</div>

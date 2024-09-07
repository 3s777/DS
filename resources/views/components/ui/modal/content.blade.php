@props([
    'tag' => 'div',
    'size' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'modal__content',
            'modal__content_size_'.$size => $size
        ])
    }}>
    {{ $slot }}
</{{ $tag }}>

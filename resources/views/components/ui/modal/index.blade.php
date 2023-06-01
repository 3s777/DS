@props([
    'tag' => 'div',
    'content' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'modal',
        ])
    }}>
    {{ $slot }}
</{{ $tag }}>

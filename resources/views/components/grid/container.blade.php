@props([
    'tag' => 'div'
])

<{{ $tag }}
    {{ $attributes->class([
            'container'
        ])
    }}>
    {{ $slot }}
</{{ $tag }}>

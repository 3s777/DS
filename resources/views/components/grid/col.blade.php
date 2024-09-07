@props([
    'tag' => 'div'
])

<{{ $tag }} {{ $attributes->class([$col]) }}>
    {{ $slot }}
</{{ $tag }}>

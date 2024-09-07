@props([
    'tag' => 'h2',
    'size' => false,
    'indent' => false
])

<{{ $tag }} {{ $attributes->class(['title', 'title_size_'.$size => $size, 'title_indent_'.$indent => $indent ]) }}>
    {{ $slot }}
</{{ $tag }}>

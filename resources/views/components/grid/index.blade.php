@props([
    'tag' => 'div',
    'type' => false
])

<{{ $tag }} {{ $attributes->class([ $type ? 'grid_'.$type : 'grid' ]) }}>
    <x-grid.row>{{ $slot }}</x-grid.row>
</{{ $tag }}>

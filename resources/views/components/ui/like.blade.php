@props([
    'size' => false,
    'type' => 'standard',
    'status' => false,
    'count' => false
])

<div
    {{ $attributes->class([
                'like',
                'like_'.$type,
                'like_size_'.$size => $size,
                'like_'.$status => $status,
            ])
    }}>

    @if($size == 'small')
        {{ $slot }} + {{ $count }}
    @endif

</div>

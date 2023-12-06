@props([
    'mainPhoto' => false,
    'additionalPhotos' => false
])

<div
    {{ $attributes->class([
            'item-photos'
        ])
    }}>
    @if($mainPhoto)
        <div
            {{  $mainPhoto->attributes->class([
                    'item-photos__main'
                ])
            }}>
            {{ $mainPhoto }}
        </div>
    @endif
    @if($additionalPhotos)
        <div
            {{  $additionalPhotos->attributes->class([
                    'item-photos__additional'
                ])
            }}>
            {{ $additionalPhotos }}
        </div>
    @endif

    {{ $slot }}
</div>

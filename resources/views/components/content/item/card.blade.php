@props([
    'photos' => false,
    'info' => false
])

<x-ui.card
    body=''
    {{ $attributes->class([
        'item-card'
        ])
    }}>

    @if($photos)
        <div
            {{ $photos->attributes->class([
                    'item-card__photos'
                ])
            }}>
            {{ $photos }}
        </div>
    @endif

    @if($info)
        <div
            {{ $info->attributes->class([
                    'item-card__info'
                ])
            }}>
            {{ $info }}
        </div>
    @endif

</x-ui.card>

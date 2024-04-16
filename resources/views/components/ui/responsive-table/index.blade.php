@props([
    'footer' => false
])
<div
    {{ $attributes->class([
            'responsive-table'
        ])
    }}>

    {{ $slot }}
</div>
@if($footer)
    <div
        {{ $footer->attributes->class([
                'responsive-table__footer'
            ])
        }}>
        {{ $footer }}
    </div>
@endif



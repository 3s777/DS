@props([
    'footer' => false,
    'data' => false,
])
<div
    {{ $attributes->class([
            'responsive-table'
        ])
    }}>

    {{ $slot }}
</div>

@if($data)
    <x-common.missing>
        {{ __('common.not_found') }}
    </x-common.missing>
@endif

@if($footer)
    <div
        {{ $footer->attributes->class([
                'responsive-table__footer'
            ])
        }}>
        {{ $footer }}
    </div>
@endif



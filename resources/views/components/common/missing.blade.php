@props([
    'icon' => true,
    'card' => false,
])

<div
    {{ $attributes->class([
        'missing',
        ])
    }}>

    @if($card)
        <x-ui.card class="card missing__card" :body="false">

        @if($icon)
            <x-svg.missing></x-svg.missing>
        @endif

        {{ $slot }}

        </x-ui.card>
    @else
        @if($icon)
            <x-svg.missing></x-svg.missing>
        @endif

        {{ $slot }}
    @endif
</div>

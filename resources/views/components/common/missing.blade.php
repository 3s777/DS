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
        <x-ui.card class="missing__card" :body="false">
    @endif
        @if($icon)
            <x-svg.missing></x-svg.missing>
        @endif

        {{ $slot }}
    @if($card)
        </x-ui.card>
    @endif
</div>

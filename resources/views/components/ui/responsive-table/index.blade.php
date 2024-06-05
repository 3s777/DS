@props([
    'footer' => false,
    'empty' => false,
])
<div class="responsive-table__wrapper">
    <div
        {{ $attributes->class([
                'responsive-table'
            ])
        }}>

        {{ $slot }}
    </div>

    @if($empty)
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
</div>




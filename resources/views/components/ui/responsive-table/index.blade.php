@props([
    'footer' => false,
    'empty' => false,
])

<div class="responsive-table__scroll-buttons responsive-table__scroll-buttons_static">
    <x-ui.form.button class="responsive-table__scroll-button responsive-table__scroll-button_left" onclick="leftScroll()"></x-ui.form.button>
    <x-ui.form.button class="responsive-table__scroll-button responsive-table__scroll-button_right" onclick="rightScroll()"></x-ui.form.button>
</div>

<div class="responsive-table__wrapper">
        <div class="responsive-table__scroll-buttons responsive-table__scroll-buttons_fixed">
            <x-ui.form.button class="responsive-table__scroll-button responsive-table__scroll-button_left" onclick="leftScroll()"></x-ui.form.button>
            <x-ui.form.button class="responsive-table__scroll-button responsive-table__scroll-button_right" onclick="rightScroll()"></x-ui.form.button>
        </div>


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




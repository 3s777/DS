@props([
    'specifications' => false,
    'starRating' => false,
    'description' => false,
    'buttons' => false,
    'indent' => true,
    'saveButtons' => true
])

<x-ui.card
    color="dark"
    body=""
    {{ $attributes->class([
            'item-specifications',
            'item-specifications_indent' => $indent
         ])
    }}>
<div class="item-specifications__wrapper">

    @if($specifications)
        <div
            {{ $specifications->attributes->class([
                    'item-specifications__main'
                ])
            }}>
            {{ $specifications }}
        </div>
    @endif

    @if($starRating)
        <div
            {{ $starRating->attributes->class([
                    'item-specifications__star-rating'
                ])
            }}>
            {{ $starRating }}
        </div>
    @endif


</div>

    @if($description)
        <div
            {{ $description->attributes->class([
                    'item-specifications__description'
                ])
            }}>
            {{ $description }}
        </div>
    @endif

    @if($buttons)
        <div
            {{ $buttons->attributes->class([
                    'item-specifications__buttons'
                ])
            }}>
            <div class="item-specifications__conversation-buttons">
                {{ $buttons }}
            </div>

            @if($saveButtons)
                <div class="item-specifications__save-buttons">
                    <x-ui.form.button
                        class="item-specifications__button"
                        title="{{ __('Добавить в список желаний') }}"
                        size="big"
                        color="light"
                        only-icon="true">
                        <x-slot:icon class="button__icon-wrapper_wishlist">
                            <x-svg.wishlist class="button__icon button__icon_small"></x-svg.wishlist>
                        </x-slot:icon>
                    </x-ui.form.button>
                    <x-ui.form.button
                        class="item-specifications__button"
                        title="{{ __('Добавить в избранное') }}"
                        size="big"
                        color="light"
                        only-icon="true">
                        <x-slot:icon class="button__icon-wrapper_star">
                            <x-svg.star class="button__icon button__icon_small"></x-svg.star>
                        </x-slot:icon>
                    </x-ui.form.button>
                </div>
            @endif
        </div>
    @endif
</x-ui.card>

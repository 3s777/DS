@props([
    'type' => 'carousel',
    'pagination' => false,
    'navigation' => false
])

<div
    {{ $attributes->class([
            'swiper',
        ])
    }}>
    <div class="swiper__{{ $type }}">
        <div class="swiper-wrapper">
            {{ $slot }}
        </div>

        @if($pagination)
            <div {{ $pagination->attributes->class([
                    'swiper-pagination',
                ])
            }}>
            </div>
        @endif

        @if($navigation)
            <div
                {{ $navigation->attributes->class([
                    'swiper-button-prev',
                ])
            }}></div>
            <div
                {{ $navigation->attributes->class([
                    'swiper-button-next',
                ])
            }}></div>
        @endif
    </div>
</div>

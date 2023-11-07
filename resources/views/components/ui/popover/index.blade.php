@props([
    'tagTitle' => 'div',
    'title' => false,
    'close' => false,
    'tail' => false,
    'contentClass' => false,
    'footer' => false
])

<div
    {{ $attributes->class([
            'popover',
            'popover_tail_'.$tail => $tail,
        ])
    }}>
    <div class="popover__inner">
        @if($title)
            <{{ $tagTitle }} class="popover__title">
                {{ $title }}
            </{{ $tagTitle }}>
        @endif
        <div class="popover__content {{ $contentClass }}">
            {{ $slot }}
        </div>

        @if($footer)
            <div
                {{ $footer->attributes->class([
                    'popover__footer',
                    ])
                }}>
                {{ $footer }}
            </div>
        @endif

        @if($close)
            <div
                {{ $close->attributes->class([
                    'popover__close',
                    ])
                }}>
                {{ $close }}
            </div>
        @endif
    </div>
</div>

@props([
    'tag_title' => 'div',
    'title' => false,
    'close' => false,
    'tail' => false,
    'content_class' => false,
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
            <{{ $tag_title }} class="popover__title">
                {{ $title }}
            </{{ $tag_title }}>
        @endif
        <div class="popover__content {{ $content_class }}">
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

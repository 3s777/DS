@props([
    'header' => false,
    'footer' => false,
    'tag' => 'div',
    'title' => false,
    'indentBottom' => false,
    'size' => false,
    'color' => false
])

<{{ $tag }}
    {{ $attributes->class([
            'card',
            'card_indent-bottom' => $indentBottom,
            'card_size_'.$size => $size,
            'card_color_'.$color => $color
        ])
    }}>
    @if($title)
        <header class="card__header">
            <h2 class="title card__title">
                {{ $title }}
            </h2>
        </header>
    @endif

    @if($header)
        <header {{ $header->attributes->class(['card__header']) }}>
            {{ $header }}
        </header>
    @endif

    <div class="card__body">
        {{ $slot }}
    </div>

    @if($footer)
        <div {{ $footer->attributes->class(['card__footer']) }}>
            {{ $footer }}
        </div>
    @endif
</{{ $tag }}>

@props([
    'header' => false,
    'footer' => false,
    'tag' => 'div',
    'title' => false,
    'indent_bottom' => false,
    'size' => false
])

<{{ $tag }} {{ $attributes->class([
        'card',
        'card_indent_bottom' => $indent_bottom,
        'card_size_'.$size => $size
    ]) }}>
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

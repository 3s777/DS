@if($srcFull)
    <a href="{{ $srcFull }}" data-fancybox data-caption="{{ $caption }}">
@endif
    <img {{ $attributes->class([
            'item-card__main-img'
        ])
    }}
        src="{{ $src }}"
        loading="lazy"
        decoding="async"
        alt="{{ $caption }}"
        title="{{ $caption }}"
    />
 @if($srcFull)
    </a>
@endif

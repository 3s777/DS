{{--TODO: convert src_full to srcFull in Image component --}}

@props([
    'caption' => '',
    'src' => '',
    'src_full' => '',
])
@if($src_full)
    <a href="{{ $src_full }}" data-fancybox data-caption="{{ $caption }}">
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
 @if($src_full)
    </a>
@endif

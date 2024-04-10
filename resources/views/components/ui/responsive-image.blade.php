@if(!$path && $placeholder)
    <x-ui.image-placeholder></x-ui.image-placeholder>
@else
    <picture {{ $attributes->class([
        'responsive-image'
    ]) }}>
        <source
            type="image/webp"
            srcset="
            @foreach($imageSizesFiltered as $size)
                {{ asset('storage/images/'.$imgPathInfo['dirname'].'/webp/'.$size[0].'x'.$size[1].'/'.$imgPathInfo['filename'].'.webp '.$size[0].'w,')}}
            @endforeach
            {{ asset('storage/images/'.$imgPathInfo['dirname'].'/'.$imgPathInfo['filename'].'.webp') }} 2048w,
        "
            sizes="{{ $sizes }}"
        />
        <img
            {{ $img->attributes->class([
                'responsive-image__img'
            ])->merge([
                'loading' => 'lazy',
                'decoding' => 'async'
            ]) }}
            src="{{ asset('storage/images/'.$fallbackSource) }}"
        />
    </picture>
@endif

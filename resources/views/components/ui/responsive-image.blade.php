<picture>
    <source
        type="image/webp"
        srcset="

                {{ asset('storage/images/'.$imgPath['dirname'].'/webp/300x300/'.$imgPath['filename'].'.webp') }} 300w,
                {{ asset('storage/images/'.$imgPath['dirname'].'/webp/400x400/'.$imgPath['filename'].'.webp') }} 400w,
                {{ asset('storage/images/'.$imgPath['dirname'].'/webp/550x550/'.$imgPath['filename'].'.webp') }} 550w,
                {{ asset('storage/images/'.$imgPath['dirname'].'/webp/600x600/'.$imgPath['filename'].'.webp') }} 600w,
                {{ asset('storage/images/'.$imgPath['dirname'].'/webp/1000x1000/'.$imgPath['filename'].'.webp') }} 1000w,
                {{ asset('storage/images/'.$imgPath['dirname'].'/webp/1200x1200/'.$imgPath['filename'].'.webp') }} 1200w,
                {{ asset('storage/images/'.$imgPath['dirname'].'/'.$imgPath['filename'].'.webp') }} 2048w,
        "
        sizes="{{ $sizes }}"
    />
    <img
        style="max-width: 100%"
        src="{{ asset('storage/images/'.$gameDeveloper->thumb_path) }}"
        loading="lazy"
        decoding="async"
        alt="Test image"
        title="Test image"
    />
</picture>

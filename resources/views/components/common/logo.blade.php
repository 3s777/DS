@props([
    'link' => '/',
    'class_site_icon' => false,
    'class_site_name' => false,
])

<div
    {{ $attributes->class(
            'logo'
        )
    }}>
    <a class="logo__link" href="{{ $link }}">
        <x-svg.logo.site-icon class="{{ $class_site_icon }}" ></x-svg.logo.site-icon>
        <x-svg.logo.site-name class="{{ $class_site_name }}" ></x-svg.logo.site-name>
    </a>
</div>

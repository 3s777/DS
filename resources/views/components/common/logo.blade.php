@props([
    'link' => '/',
    'classSiteIcon' => false,
    'classSiteName' => false,
])

<div
    {{ $attributes->class([
        'logo'
    ])
    }}>
    <a class="logo__link" href="{{ $link }}">
        <x-svg.logo.site-icon class="{{ $classSiteIcon }}" ></x-svg.logo.site-icon>
        <x-svg.logo.site-name class="{{ $classSiteName }}" ></x-svg.logo.site-name>
    </a>
</div>

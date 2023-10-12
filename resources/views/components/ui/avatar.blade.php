@props([
    'link',
    'src',
    'username'
])

<div
    {{ $attributes->class([
            'avatar',
        ])
    }}>
    <a href="{{ $link }}">
        <img src="{{ $src }}" alt="{{ $username }}">
    </a>
</div>




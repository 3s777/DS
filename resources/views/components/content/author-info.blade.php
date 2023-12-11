@props([
    'photo',
    'name',
    'username',
    'rating'
])

<div
    {{ $attributes->class([
            'author-info'
        ])
    }}>
    <div class="author-info__main">
        <div class="author-info__thumbnail">
            <a href=""><img class="author-info__img" src="{{ $photo }}" alt=""></a>
        </div>
        <div class="author-info__content">
            <div class="author-info__name"><a href="">{{ $name }}</a></div>
            <div class="author-info__nickname"><a href=""><span>@</span>{{ $username }}</a></div>
        </div>
    </div>

    <x-content.rating
        class="author-info__rating"
        rating="9"/>
</div>

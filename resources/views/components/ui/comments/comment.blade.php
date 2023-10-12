@props([
    'footer' => false,
    'type' => 'parent',
    'color' => false,
    'avatar_url',
    'username',
    'user_link',
    'date',
    'likes_count',
    'likes_status',
])

<div
    {{ $attributes->class([
            'comment',
            'comments__item',
            'comment_'.$type => $type,
            'comment_color_'.$color => $color
        ])
    }}>

        <x-ui.avatar
            class="comment__avatar"
            link="{{ $user_link }}"
            src="{{ $avatar_url }}"
            username="{{ $username }}"
        >
        </x-ui.avatar>

        <div class="comment__content">
            <div class="comment__header">
                <div class="comment__username">
                    <a class="comment__user-button button button_submit" href="{{ $user_link }}">{{ $username }}</a>
                </div>
                <div class="comment__date">{{ $date }}</div>
            </div>
            <div class="comment__text">
                {{ $slot }}
            </div>
            <div class="comment__footer">
                <x-ui.like
                    class="comment__like"
                    count="{{ $likes_count }}"
                    size="small"
                    status="{{ $likes_status }}"
                    type="like">
                    <x-svg.like class="like__icon"></x-svg.like>
                </x-ui.like>
                <a class="comment__reply" href="#">{{ __('Reply') }}</a>
            </div>
        </div>

</div>




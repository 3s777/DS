@props([
    'footer' => false,
    'type' => 'parent',
    'color' => false,
    'avatarUrl',
    'username',
    'userLink',
    'date',
    'likesCount',
    'likesStatus',
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
            link="{{ $userLink }}"
            src="{{ $avatarUrl }}"
            username="{{ $username }}"
        >
        </x-ui.avatar>

        <div class="comment__content">
            <div class="comment__header">
                <div class="comment__username">
                    <a class="comment__user-button button button_submit" href="{{ $userLink }}">{{ $username }}</a>
                </div>
                <div class="comment__date">{{ $date }}</div>
            </div>
            <div class="comment__text">
                {{ $slot }}
            </div>
            <div class="comment__footer">
                <x-ui.like
                    class="comment__like"
                    count="{{ $likesCount }}"
                    size="small"
                    status="{{ $likesStatus }}"
                    type="like">
                    <x-svg.like class="like__icon"></x-svg.like>
                </x-ui.like>
                <a class="comment__reply" href="#">{{ __('Reply') }}</a>
            </div>
        </div>

</div>




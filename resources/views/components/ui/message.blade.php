@props([
    'tag' => 'div',
    'type' => 'success',
    'icon' => false,
    'close' => false
])

@if($close)
    <div class="message__wrapper" x-data="{ show_message: true }">
@endif
    <{{ $tag }}
        {{ $attributes->class([
                'message',
                'message_'.$type => $type,
                'message_icon' => $icon,
                'message_closed' => $close
            ])
        }}>

        @if($icon)
            <div {{ $icon->attributes->class([
                        'message__icon'
                    ]) }}>
                {{ $icon }}
            </div>
        @endif

        {{ $slot }}

        @if($close)
            <div
                {{ $close->attributes->class([
                        'message__close'
                    ]) }}>
                @include('inline-svg/close', ['class' => 'message__close-icon'])
            </div>
        @endif
    </{{ $tag }}>
@if($close)
    </div>
@endif

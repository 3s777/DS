@props([
    'count' => false,
    'link' => '/'
])
<a href="{{ $link }}">
    <div
        {{ $attributes->class([
                'chat-icon-notification'
            ])
        }}>
        <div class="chat-icon-notification__icon">
            <x-svg.message class="chat-icon-notification__svg" />
        </div>
        @if($count)
            <x-ui.badge
                class="chat-icon-notification__badge"
                type="number">
                {{ $count }}
            </x-ui.badge>
        @endif
    </div>
</a>

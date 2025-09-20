<div>
    @auth('collector')
        @if($isSubscribed)
            Подписан
        @else
            <x-ui.form.button wire:click="subscribe" class="collector-preview__subscribe-button" size="small">
                Подписаться
            </x-ui.form.button>
        @endif
    @endauth
</div>

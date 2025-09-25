<div>
    @if($isSubscribed)
        <x-ui.form.button wire:click="unsubscribe" class="collector-preview__subscribe-button" size="small" color="cancel">
            Отписаться
        </x-ui.form.button>
    @else
        <x-ui.form.button wire:click="subscribe" class="collector-preview__subscribe-button" size="small">
            Подписаться
        </x-ui.form.button>
    @endif
        <div x-text="$wire.test">www</div>
        <span wire:loading>Saving...</span>
</div>

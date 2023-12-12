<div
    {{ $attributes->class([
            'item-additional-info'
        ])
    }}>

    {{ $slot }}

    <div class="tem-additional-info__links">
        <x-ui.form.button tag="a" link="{{ route('game-carrier') }}" color="info">{{__('Подробнее об издании')}}</x-ui.form.button>
    </div>
</div>

@if($message = flash()->get())
    <x-ui.message
        {{ $attributes->class([]) }}
        type="{{ $message->type() }}">
        @if($message->icon())
            <x-slot:icon class="message__icon_{{ $message->type() }}">
                <x-dynamic-component :component="$message->icon()" class="message__{{ $message->type() }}-icon"></x-dynamic-component>
            </x-slot:icon>
        @endif
        {{ $message->message() }}
    </x-ui.message>
@endif

@if ($errors->any())
    <x-ui.message {{ $attributes->class([]) }} type="danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </x-ui.message>
@endif

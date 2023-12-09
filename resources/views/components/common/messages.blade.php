@if($message = flash()->get())
    <x-ui.message
        class="auth__message"
        type="{{ $message->type() }}">
        @if($message->icon())
            <x-slot:icon class="message__icon_{{ $message->type() }}">
                <x-dynamic-component :component="$message->icon()" class="message__{{ $message->type() }}-icon"></x-dynamic-component>
            </x-slot:icon>
        @endif
        {{ $message->message() }}
    </x-ui.message>
@endif

{{--@if (session('status'))--}}
{{--<x-ui.message class="auth__message" type="info">--}}
{{--{{ session('status') }}--}}
{{--</x-ui.message>--}}
{{--@endif--}}

@if ($errors->any())
    <x-ui.message class="auth__message" type="danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </x-ui.message>
@endif

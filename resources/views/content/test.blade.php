@extends('layouts.auth')

@section('title', __('Game Carrier'))

@section('content')
<div class="container">
    <div class="content carrier">
        <div x-data :class="$store.darkMode.on && 'bg-black'">vcbcv</div>
        <button x-data @click="$store.darkMode.toggle()">Toggle Dark Mode</button>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module">
        Alpine.store('darkMode', {
            on: false,

            toggle() {
                this.on = ! this.on
                console.log(this.on);
            }
        })
        Alpine.start()
    </script>
@endpush

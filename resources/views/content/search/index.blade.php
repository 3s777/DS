@extends('layouts.auth')

@section('title', __('Search'))

@section('content')
    <div class="container">
        <div class="content carrier">
            <x-grid type="container">
                <x-grid.col lg="6" xl="6" md="6" sm="12">
            Search
                </x-grid.col>
            </x-grid>
        </div>
    </div>


@endsection

@push('scripts')
    <script type="module">

    </script>
@endpush

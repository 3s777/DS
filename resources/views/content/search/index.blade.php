@extends('layouts.auth')

@section('title', __('Search'))

@section('content')
    <div class="container">
        <div class="content search">
            <div class="search__result">
                <x-grid type="container">
                        <x-grid.col xl="3" ml="4" sm="6" >
                            <x-ui.card size="small">
                                <div class="search__item search-card">
                                    <div class="search-card__main">
                                        <div class="search-card__thumbnail">
                                            <img class="search-card__img" src="{{ asset('/storage/test-300.jpg') }}" alt="">
                                        </div>
                                        <div class="search-card__info">
                                            <div class="search-card__title">Naruto Shippuden Ultimate Ninfa Storm Collection</div>
                                            <div class="search-card__details">
                                                <div class="search-card__detail">
                                                    Playstation 3
                                                </div>
                                                <div class="search-card__detail">
                                                    BLES00789
                                                </div>
                                                <div class="search-card__detail">
                                                    Essentials
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-card__buttons">
                                            <x-ui.form.button
                                                class="search-card__button"
                                                tag="a"
                                                link="/"
                                                only_icon="true"
                                                size="small"
                                                color="dark"
                                                title="{{ __('На полках') }}">
                                                <x-slot:icon>
                                                    <x-svg.check></x-svg.check>
                                                </x-slot:icon>
                                                <x-slot:badge>
                                                    <x-ui.badge
                                                        class="search-card__badge"
                                                        type="number"
                                                        align="standard"
                                                        color="success">
                                                        12
                                                    </x-ui.badge>
                                                </x-slot:badge>
                                            </x-ui.form.button>

                                            <x-ui.form.button
                                                class="search-card__button"
                                                tag="a"
                                                link="/"
                                                only_icon="true"
                                                size="small"
                                                color="dark"
                                                title="{{ __('Желают') }}">
                                                <x-slot:icon>
                                                    <x-svg.wishlist></x-svg.wishlist>
                                                </x-slot:icon>
                                                <x-slot:badge>
                                                    <x-ui.badge
                                                        class="search-card__badge"
                                                        type="number"
                                                        align="standard"
                                                        color="success">
                                                        1200
                                                    </x-ui.badge>
                                                </x-slot:badge>
                                            </x-ui.form.button>

                                            <x-ui.form.button
                                                class="search-card__button"
                                                tag="a"
                                                link="/"
                                                only_icon="true"
                                                size="small"
                                                color="dark"
                                                title="{{ __('Продажа') }}">
                                                <x-slot:icon>
                                                    <x-svg.dollar></x-svg.dollar>
                                                </x-slot:icon>
                                                <x-slot:badge>
                                                    <x-ui.badge
                                                        class="search-card__badge"
                                                        type="number"
                                                        align="standard"
                                                        color="success">
                                                        5
                                                    </x-ui.badge>
                                                </x-slot:badge>
                                            </x-ui.form.button>

                                            <x-ui.form.button
                                                class="search-card__button"
                                                tag="a"
                                                link="/"
                                                only_icon="true"
                                                size="small"
                                                color="dark"
                                                title="{{ __('Аукционы') }}">
                                                <x-slot:icon>
                                                    <x-svg.auction></x-svg.auction>
                                                </x-slot:icon>
                                                <x-slot:badge>
                                                    <x-ui.badge
                                                        class="search-card__badge"
                                                        type="number"
                                                        align="standard"
                                                        color="success">
                                                        2
                                                    </x-ui.badge>
                                                </x-slot:badge>
                                            </x-ui.form.button>

                                            <x-ui.form.button
                                                class="search-card__button"
                                                tag="a"
                                                link="/"
                                                only_icon="true"
                                                size="small"
                                                color="dark"
                                                title="{{ __('Обмен') }}">
                                                <x-slot:icon>
                                                    <x-svg.exchange></x-svg.exchange>
                                                </x-slot:icon>
                                                <x-slot:badge>
                                                    <x-ui.badge
                                                        class="search-card__badge"
                                                        type="number"
                                                        align="standard"
                                                        color="success">
                                                        2
                                                    </x-ui.badge>
                                                </x-slot:badge>
                                            </x-ui.form.button>

                                            <x-ui.form.button
                                                class="search-card__button"
                                                tag="a"
                                                link="/"
                                                only_icon="true"
                                                size="small"
                                                color="dark"
                                                title="{{ __('В избранном') }}">
                                                <x-slot:icon>
                                                    <x-svg.star></x-svg.star>
                                                </x-slot:icon>
                                                <x-slot:badge>
                                                    <x-ui.badge
                                                        class="search-card__badge"
                                                        type="number"
                                                        align="standard"
                                                        color="success">
                                                        153
                                                    </x-ui.badge>
                                                </x-slot:badge>
                                            </x-ui.form.button>

                                    </div>
                                </div>
                            </x-ui.card>
                        </x-grid.col>
                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.card size="small">Тест</x-ui.card>
                        </x-grid.col>
                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.card size="small">Тест</x-ui.card>
                        </x-grid.col>
                        <x-grid.col xl="3" lg="4" md="6" sm="12">
                            <x-ui.card size="small">Тест</x-ui.card>
                        </x-grid.col>
                </x-grid>
            </div>
        </div>
    </div>


@endsection

@push('scripts')
    <script type="module">

    </script>
@endpush

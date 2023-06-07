@extends('layouts.auth')

@section('title', __('Game Carrier'))

@section('content')
<div class="container">
    <div class="content carrier">
        <div class="content__title">
            <x-ui.title tag="h1" size="large" >
                {{ __('Resonance of Fate') }}
            </x-ui.title>
            <div class="content__title-tags carrier__title-tags">
                <x-ui.tag href="/">Playstation 3</x-ui.tag>
                <x-ui.tag href="">BLES00789</x-ui.tag>
                <x-ui.tag indent="" href="">BLUS30484</x-ui.tag>
            </div>
        </div>
        <x-grid type="container">
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.card>
                    <a href="{{ asset('/storage/test.jpg') }}" data-fancybox data-caption="Single image">
                        <picture class="image">
                            <source
                                type="image/webp"
                                srcset="
                                        {{ asset('/storage/test-300.webp') }} 300w,
                                        {{ asset('/storage/test-650.webp') }} 650w,
                                        {{ asset('/storage/test-800.webp') }} 800w,
                                        {{ asset('/storage/test-1200.webp') }} 1200w,
                                        {{ asset('/storage/test-1500.webp') }} 1500w,
                                        {{ asset('/storage/test.webp') }} 3000w,
                                    "
                                sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                            />
                            <img
                                src="{{ asset('/storage/test.jpg') }}"
                                srcset="
                                        {{ asset('/storage/test-300.jpg') }} 300w,
                                        {{ asset('/storage/test-650.jpg') }} 650w,
                                        {{ asset('/storage/test-800.jpg') }} 800w,
                                        {{ asset('/storage/test-1200.jpg') }} 1200w,
                                        {{ asset('/storage/test-1jpg') }} 1500w,
                                        {{ asset('/storage/test.jpg') }} 3000w,
                                    "
                                sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </picture>
                    </a>
                </x-ui.card>
            </x-grid.col>
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.card>
                <x-grid type="container">
                    <x-grid.col xl="12" lg="6" md="6" sm="12">
                        <x-ui.specifications>
                            <x-ui.specifications.item title="Платформа">
                                <x-ui.tag color="dark">Playstation 3</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Коды игры">
                                <x-ui.tag color="dark">BLES00789</x-ui.tag>
                                <x-ui.tag color="dark">BLES00789/P</x-ui.tag>
                                <x-ui.tag color="dark">BLUS30484</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Жанр">
                                <x-ui.tag color="dark">Платформер</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Разработчик">
                                <x-ui.tag color="dark">Capcom</x-ui.tag>
                                <x-ui.tag color="dark">Namco</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Издатель">
                                <x-ui.tag color="dark">Namco</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Даты выхода">
                                Pal: 08.09.2006, JP: 07.07.2007, NA: 12.11.2006
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Тип издания">
                                <x-ui.tag color="dark">Classic</x-ui.tag>
                                <x-ui.tag color="dark">Essential</x-ui.tag>
                                <x-ui.tag color="dark">Platinum</x-ui.tag>
                                <x-ui.tag color="dark">Limited</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Языки">
                                Английский, Русский, Французский, Японский, Испанский
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Другие названия">
                                <div>Resonance of Fate Exploited</div>
                                <div>Сопротивление судьбы</div>
                            </x-ui.specifications.item>
                            <div class="description">
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                            </div>
                        </x-ui.specifications>
                    </x-grid.col>
                </x-grid>
                </x-ui.card>
            </x-grid.col>
        </x-grid>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module">
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });
    </script>
@endpush

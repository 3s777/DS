<x-ui.card>
    <x-ui.title indent="normal">Другие издания</x-ui.title>

    <x-libraries.swiper class="carrier__swiper-relative" id="swiper_relative">

        <x-libraries.swiper.slide>
            <a href="/">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
                <span class="carrier__relative-link">Xbox One 505550</span>
            </a>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <a href="/">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-2.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
                <span class="carrier__relative-link">Коллекционное издание Xbox One 505550 Xbox One 505550</span>
            </a>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <a href="/">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-3.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
                <span class="carrier__relative-link" >Тест Xbox One 505550</span>
            </a>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <a href="/">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-4.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
                <span class="carrier__relative-link">Playstation 4 Test Test</span>
            </a>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <a href="/">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-5.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
                <span class="carrier__relative-link">Test test test test test dfsdafsdafsdfasdf</span>
            </a>
        </x-libraries.swiper.slide>

        <x-slot:pagination class="swiper-pagination_1"></x-slot:pagination>
        <x-slot:navigation>1</x-slot:navigation>

    </x-libraries.swiper>
</x-ui.card>

<x-ui.card>
    <x-ui.title indent="normal">Другие издания</x-ui.title>

    <x-libraries.swiper class="variation__swiper-relative" id="swiper_relative">

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
                <span class="variation__relative-link">Xbox One 505550</span>
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
                <span class="variation__relative-link">Коллекционное издание Xbox One 505550 Xbox One 505550</span>
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
                <span class="variation__relative-link" >Тест Xbox One 505550</span>
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
                <span class="variation__relative-link">Playstation 4 Test Test</span>
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
                <span class="variation__relative-link">Test test test test test dfsdafsdafsdfasdf</span>
            </a>
        </x-libraries.swiper.slide>

        <x-slot:pagination class="swiper-pagination_1"></x-slot:pagination>
        <x-slot:navigation>1</x-slot:navigation>

    </x-libraries.swiper>
</x-ui.card>

@push('scripts')
    <script type="module">
        const swiper = new Swiper('#swiper_relative', {
            direction: 'horizontal',
            spaceBetween: 16,
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination_1',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                },
                576: {
                    slidesPerView: 2,
                },
            }
        });
    </script>
@endpush

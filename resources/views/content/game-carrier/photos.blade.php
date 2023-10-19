
<x-ui.card style="overflow: hidden;">
    <div style="width:100%; overflow: hidden;">
        <x-libraries.swiper type="full" class="carrier__swiper-main">

            <x-libraries.swiper.slide >
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide class="ui__test-swiper-slide">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-2.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide class="ui__test-swiper-slide">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-3.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide class="ui__test-swiper-slide">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-4.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide class="ui__test-swiper-slide">
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-5.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>

            <x-slot:pagination class="swiper-pagination_2"></x-slot:pagination>
            <x-slot:navigation></x-slot:navigation>

        </x-libraries.swiper>
    </div>
</x-ui.card>

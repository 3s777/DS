<section class="ui__section">
    <x-ui.title size="big" indent="big" >{{ __('Swiper') }}</x-ui.title>

    <x-ui.card>

        <x-libraries.swiper class="swiper ui__swiper">

            <x-libraries.swiper.slide>
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide>
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-2.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide>
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-3.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide>
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-4.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>
            <x-libraries.swiper.slide>
                <img
                    class="swiper__img"
                    src="{{ asset('/storage/test-5.jpg') }}"
                    loading="lazy"
                    decoding="async"
                    alt="Test image"
                    title="Test image"
                />
            </x-libraries.swiper.slide>

            <x-slot:pagination class="swiper-pagination_1"></x-slot:pagination>
            <x-slot:navigation>1</x-slot:navigation>

        </x-libraries.swiper>

        <x-libraries.swiper type="full">

            <x-libraries.swiper.slide class="ui__test-swiper-slide">
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
    </x-ui.card>
</section>

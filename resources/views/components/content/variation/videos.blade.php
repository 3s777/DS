<x-ui.card>
    <x-ui.title indent="normal">Видео</x-ui.title>

    <x-libraries.swiper
        class="variation__swiper-video"
        id="variation_video"
        type="carousel">

        <x-libraries.swiper.slide>
            <div x-data x-on:keydown.escape.window="$store.modal.hide = true, handleClick(variation_video1)">
                <div x-on:click.stop="$store.modal.hide = ! $store.modal.hide">
                    <x-ui.video-thumbnail class="variation__video-thumbnail">
                        <img
                            class="swiper__img"
                            src="{{ asset('/storage/test.jpg') }}"
                            loading="lazy"
                            decoding="async"
                            alt="Test image"
                            title="Test image"
                        />
                    </x-ui.video-thumbnail>
                    <span class="variation__video-link">Xbox One 505550</span>
                </div>
            </div>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <div x-data x-on:keydown.escape.window="$store.modal1.hide = true, handleClick(variation_video2)">
                <div x-on:click.stop="$store.modal1.hide = ! $store.modal1.hide">
                    <x-ui.video-thumbnail class="variation__video-thumbnail">
                        <img
                            class="swiper__img"
                            src="{{ asset('/storage/test-2.jpg') }}"
                            loading="lazy"
                            decoding="async"
                            alt="Test image"
                            title="Test image"
                        />
                    </x-ui.video-thumbnail>
                    <span class="variation__video-link">Коллекционное издание Xbox One 505550 Xbox One 505550</span>
                </div>
            </div>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <div x-data x-on:keydown.escape.window="$store.modal2.hide = true, handleClick(variation_video3)">
                <div x-on:click.stop="$store.modal2.hide = ! $store.modal2.hide">
                    <x-ui.video-thumbnail class="variation__video-thumbnail">
                        <img
                            class="swiper__img"
                            src="{{ asset('/storage/test-3.jpg') }}"
                            loading="lazy"
                            decoding="async"
                            alt="Test image"
                            title="Test image"
                        />
                    </x-ui.video-thumbnail>
                    <span class="variation__video-link" >Тест Xbox One 505550</span>
                </div>
            </div>
        </x-libraries.swiper.slide>

        <x-slot:pagination class="swiper-pagination_1"></x-slot:pagination>
        <x-slot:navigation>1</x-slot:navigation>

    </x-libraries.swiper>
</x-ui.card>

@push('scripts')
    <script type="module">
        const swiperVideo = new Swiper('#variation_video', {
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
                576: {
                    slidesPerView: 2,
                },
            }
        });
    </script>
@endpush

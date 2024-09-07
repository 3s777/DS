<x-ui.card>
    <x-ui.title indent="normal">Видео</x-ui.title>

    <x-libraries.swiper
        class="carrier__swiper-video"
        id="carrier_video"
        type="carousel">

        <x-libraries.swiper.slide>
            <div x-data x-on:keydown.escape.window="$store.modal.hide = true, handleClick(carrier_video1)">
                <div x-on:click.stop="$store.modal.hide = ! $store.modal.hide">
                    <x-ui.video-thumbnail class="carrier__video-thumbnail">
                        <img
                            class="swiper__img"
                            src="{{ asset('/storage/test.jpg') }}"
                            loading="lazy"
                            decoding="async"
                            alt="Test image"
                            title="Test image"
                        />
                    </x-ui.video-thumbnail>
                    <span class="carrier__video-link">Xbox One 505550</span>
                </div>
            </div>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <div x-data x-on:keydown.escape.window="$store.modal1.hide = true, handleClick(carrier_video2)">
                <div x-on:click.stop="$store.modal1.hide = ! $store.modal1.hide">
                    <x-ui.video-thumbnail class="carrier__video-thumbnail">
                        <img
                            class="swiper__img"
                            src="{{ asset('/storage/test-2.jpg') }}"
                            loading="lazy"
                            decoding="async"
                            alt="Test image"
                            title="Test image"
                        />
                    </x-ui.video-thumbnail>
                    <span class="carrier__video-link">Коллекционное издание Xbox One 505550 Xbox One 505550</span>
                </div>
            </div>
        </x-libraries.swiper.slide>
        <x-libraries.swiper.slide>
            <div x-data x-on:keydown.escape.window="$store.modal2.hide = true, handleClick(carrier_video3)">
                <div x-on:click.stop="$store.modal2.hide = ! $store.modal2.hide">
                    <x-ui.video-thumbnail class="carrier__video-thumbnail">
                        <img
                            class="swiper__img"
                            src="{{ asset('/storage/test-3.jpg') }}"
                            loading="lazy"
                            decoding="async"
                            alt="Test image"
                            title="Test image"
                        />
                    </x-ui.video-thumbnail>
                    <span class="carrier__video-link" >Тест Xbox One 505550</span>
                </div>
            </div>
        </x-libraries.swiper.slide>

        <x-slot:pagination class="swiper-pagination_1"></x-slot:pagination>
        <x-slot:navigation>1</x-slot:navigation>

    </x-libraries.swiper>
</x-ui.card>

@props([
    'model'
])

<x-ui.card style="overflow: hidden;">
    <div>
        <x-libraries.swiper type="full" class="variation__swiper-main">

            <x-libraries.swiper.slide >
                <x-ui.responsive-image
                    :model="$model"
                    :image-sizes="['small', 'medium', 'large']"
                    :path="$model->getFeaturedImagePath()"
                    :placeholder="true"
                    :wrapper="true"
                    wrapper-class=""
                    sizes="(max-width: 768px) 604px, (max-width: 1400px) 604px, 604px">
                    <x-slot:img class="swiper__img" alt="{{ $model->name }}" title="{{ $model->name }}"></x-slot:img>
                </x-ui.responsive-image>
            </x-libraries.swiper.slide>

            @foreach($model->getImages() as $image)
                <x-libraries.swiper.slide>
                    <x-ui.responsive-image
                        :model="$model"
                        :image-sizes="['small', 'medium', 'large']"
                        :path="$image"
                        :placeholder="true"
                        :wrapper="true"
                        wrapper-class=""
                        sizes="(max-width: 768px) 604px, (max-width: 1400px) 604px, 604px">
                        <x-slot:img class="swiper__img" alt="{{ $model->name }}" title="{{ $model->name }}"></x-slot:img>
                    </x-ui.responsive-image>
                </x-libraries.swiper.slide>
            @endforeach

            <x-slot:pagination class="swiper-pagination_2"></x-slot:pagination>
            <x-slot:navigation></x-slot:navigation>

        </x-libraries.swiper>
    </div>
</x-ui.card>

@push('scripts')
    <script type="module">
        const swiperFull = new Swiper('.swiper__full', {
            direction: 'horizontal',
            slidesPerView: 1,
            pagination: {
                el: '.swiper-pagination_2',
                clickable: true
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            breakpoints: {
                1024: {
                    slidesPerView: 1,
                },

                576: {
                    slidesPerView: 2,
                    spaceBetween: 16,
                },
            }
        });
    </script>
@endpush

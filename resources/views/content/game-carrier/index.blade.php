@extends('layouts.auth')

@section('title', __('Game Carrier'))

@section('content')
    <div class="container">
        <div class="content carrier">
            @include('content.game-carrier.title')

<div class="carrier__grid">
    @include('content.game-carrier.photos')

    @include('content.game-carrier.videos')

    @include('content.game-carrier.relatives')

    @include('content.game-carrier.comments')





    <x-ui.card indent_bottom="true">
        <div class="carrier__add">
            @include('content.game-carrier.add-buttons')
            @include('content.game-carrier.add-form-collection')
        </div>
    </x-ui.card>

    @include('content.game-carrier.specifications')
</div>




        </div>
    </div>

    @include('content.game-carrier.modals')

@endsection

@push('scripts')
    <script type="module">
        const element1 = document.querySelector('.choices-select-1');
        const choices1 = new Choices(element1, {
            itemSelectText: '',
            searchEnabled: false,
            shouldSort: false,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element2 = document.querySelector('.choices-select-shelf');
        const choices2 = new Choices(element2, {
            itemSelectText: '',
            searchEnabled: false,
            shouldSort: false,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element3 = document.querySelector('.choices-select-state');
        const choices3 = new Choices(element3, {
            itemSelectText: '',
            searchEnabled: false,
            shouldSort: false,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element4 = document.querySelector('.choices-select-box');
        const choices4 = new Choices(element4, {
            itemSelectText: '',
            searchEnabled: false,
            shouldSort: false,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });


        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

        document.getElementById("select-test").onchange = function(){
            var value = document.getElementById("select-test").value;
            console.log(value);
        };

        const inputElement2 = document.querySelector('.filepond2');

        const pond2 = FilePond.create(inputElement2, {
            credits: false,
            labelIdle: '<span class="filepond--label-action"> {{ __('Загрузите') }}</span> {{ __('дополнительные фото') }}',
            labelMaxFileSizeExceeded: 'Файл слишком большой',
            labelMaxFileSize: 'Максимальный размер {filesize}',
            labelFileLoading: 'Загрузка',
            labelTapToCancel: 'отменить',
            labelFileWaitingForSize: 'подождите'
        });

        FilePond.registerPlugin(
            FilePondPluginFileValidateType,
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageCrop,
            FilePondPluginImageResize,
            FilePondPluginImageTransform,
        );

        const inputElement = document.querySelector('.filepond1');
        const pond = FilePond.create(inputElement, {
            credits: false,
            labelIdle: '<span class="filepond--label-action"> {{ __('Загрузите') }}</span> {{ __('главное фото') }} '
        });


        const swiperFull = new Swiper('.swiper__full', {
            // Optional parameters
            direction: 'horizontal',
            slidesPerView: 1,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination_2',
                clickable: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },


        });

        const swiper = new Swiper('#swiper_relative', {
            // Optional parameters
            direction: 'horizontal',
            spaceBetween: 16,
            slidesPerView: 1,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination_1',
                clickable: true
            },

            // Navigation arrows
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

        const swiperVideo = new Swiper('#carrier_video', {
            // Optional parameters
            direction: 'horizontal',
            spaceBetween: 16,
            slidesPerView: 1,

            // If we need pagination
            pagination: {
                el: '.swiper-pagination_1',
                clickable: true
            },

            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },

            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                576: {
                    slidesPerView: 1,
                },
            }


        });

        var quill = new Quill('#new-comment', {
            placeholder: 'Leave your comment',
            theme: 'snow'
        });







    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('modal', {
                hide: true,

            });
            Alpine.store('modal1', {
                hide: true,
            });
            Alpine.store('modal2', {
                hide: true,
            })
        })

        function handleClick(element) {
            var iframe = element.querySelector('iframe');
            if ( iframe ) {
                var iframeSrc = iframe.src;
                iframe.src = iframeSrc;
            }
        }
    </script>


@endpush

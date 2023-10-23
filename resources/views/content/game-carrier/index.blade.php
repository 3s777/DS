@extends('layouts.auth')

@section('title', __('Game Carrier'))

@section('content')
    <div class="container">
        <div class="content carrier">

            @include('content.game-carrier.title')

            <div class="carrier__grid">
                <div class="carrier__photo">
                    @include('content.game-carrier.photos')
                </div>

                <div class="carrier__buttons">
                    <x-grid type="container">
                        <x-grid.col xl="12" lg="12" md="12" sm="12">
                            <div class="carrier__forms">
                                <x-ui.card>
                                    <div x-data = "addButtonsAttributes()"
                                         x-init="initButtonChoices()"
                                         class="carrier__add"
                                    >
                                        @include('content.game-carrier.add-buttons')
                                        @include('content.game-carrier.add-form-collection')
                                    </div>
                                </x-ui.card>
                            </div>
                        </x-grid.col>
                        <x-grid.col xl="12" lg="12" md="12" sm="12">
                            <div class="carrier__specifications">
                                @include('content.game-carrier.specifications')
                            </div>
                        </x-grid.col>
                    </x-grid>
                </div>

                <div class="carrier__videos">
                    @include('content.game-carrier.videos')
                </div>

                <div class="carrier__relatives">
                    @include('content.game-carrier.relatives')
                </div>

                <div class="carrier__comments">
                    @include('content.game-carrier.comments')
                </div>
            </div>

        </div>
    </div>

    @include('content.game-carrier.modals')

@endsection

@push('scripts')
    <script type="module">

        var selects = document.getElementsByClassName("choices-select-auto");
        for (var i = 0; i < selects.length; i++) {

            new Choices(selects.item(i), {
                itemSelectText: '',
                searchEnabled: false,
                shouldSort: false,
                allowHTML: true,
                noResultsText: '{{ __('Не найдено') }}',
                noChoicesText: '{{ __('Больше ничего нет') }}',
            });
        }

        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

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
                576: {
                    slidesPerView: 2,
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
            });

        })

        function handleClick(element) {
            var iframe = element.querySelector('iframe');
            if ( iframe ) {
                var iframeSrc = iframe.src;
                iframe.src = iframeSrc;
            }
        }

        const addButtonsAttributes = () => {
            return {
                form: 'add',
                currentForm(form) {
                    return form = form.value ? form.value : form;
                },
                activateButton(buttonForm) {
                    if(this.currentForm(this.form) === buttonForm) {
                        return 'button_submit';
                    }
                },
                setForm(form) {
                    this.form = form;
                    choices1.setChoiceByValue(form);
                }
            }
        }

        function initButtonChoices() {
            element1 = document.querySelector('.choices-select-1');
            choices1 = new Choices(element1, {
                itemSelectText: '',
                searchEnabled: false,
                shouldSort: false,
                allowHTML: true,
                noResultsText: '{{ __('Не найдено') }}',
                noChoicesText: '{{ __('Больше ничего нет') }}',
            });
        }
    </script>


@endpush

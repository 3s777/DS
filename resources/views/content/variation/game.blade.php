<x-layouts.main title="Game Carrier">
    <x-grid.container>

        <x-common.content class="carrier">

            <x-content.variation.title :title="$gameMediaVariation->name" />

            <div class="carrier__grid">
                <div class="carrier__photo">
                    <x-content.variation.photos :model="$gameMediaVariation" />
                </div>

                <div class="carrier__buttons">
                    <div class="carrier__forms">
                        <x-ui.card>
                            <div x-data = "addButtonsAttributes()"
                                 x-init="initButtonChoices()"
                                 class="carrier__add">
                                @include('content.game-carrier.add-buttons')
                                @include('content.game-carrier.add-form-collection')
                            </div>
                        </x-ui.card>
                    </div>

                    <div class="carrier__specifications">
                        <x-content.variation.specifications>

                            <x-ui.specifications>
                                <x-ui.specifications.item :title="trans_choice('game.platform.platforms', 2)">
                                    @foreach($gameMediaVariation->gameMedia->platforms as $platform)
                                        <x-ui.tag color="dark">{{ $platform->name }}</x-ui.tag>
                                    @endforeach
                                </x-ui.specifications.item>
                                <x-ui.specifications.item :title="trans_choice('game.genre.genres', 2)">
                                    @foreach($gameMediaVariation->gameMedia->genres as $genre)
                                        <x-ui.tag color="dark">{{ $genre->name }}</x-ui.tag>
                                    @endforeach
                                </x-ui.specifications.item>
                                @if($gameMediaVariation->gameMedia->released_at)
                                    <x-ui.specifications.item :title="__('game.media.released_at')">
                                        <x-ui.tag color="dark">{{ $gameMediaVariation->gameMedia->released_at->format('d.m.Y') }}</x-ui.tag>
                                    </x-ui.specifications.item>
                                @endif
                                <x-ui.specifications.item :title="trans_choice('game.games', 2)">
                                    @foreach($gameMediaVariation->gameMedia->games as $game)
                                        <x-ui.tag color="dark">{{ $game->name }}</x-ui.tag>
                                    @endforeach
                                </x-ui.specifications.item>
                                <x-ui.specifications.item :title="trans_choice('game.developer.developers', 2)">
                                    @foreach($gameMediaVariation->gameMedia->developers as $developer)
                                        <x-ui.tag color="dark">{{ $developer->name }}</x-ui.tag>
                                    @endforeach
                                </x-ui.specifications.item>
                                <x-ui.specifications.item :title="trans_choice('game.publisher.publishers', 2)">
                                    @foreach($gameMediaVariation->gameMedia->publishers as $publisher)
                                        <x-ui.tag color="dark">{{ $publisher->name }}</x-ui.tag>
                                    @endforeach
                                </x-ui.specifications.item>
                            </x-ui.specifications>

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
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                    </p>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                    </p>
                                </div>
                            </x-ui.specifications>
                        </x-content.variation.specifications>
                    </div>
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

        </x-common.content>
    </x-grid.container>

    @include('content.game-carrier.modals')

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
</x-layouts.main>

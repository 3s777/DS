<x-layouts.main title="Feed">
    <x-grid.container>
        <x-common.content class="feed">

            <x-ui.card>
                <div class="feed-item sale-item feed-item_sale">
                    <div class="feed-item__photos">
                        <div class="feed-item__main-photo">
                            <img
                                class="feed-item__img"
                                src="{{ Vite::image('620_1.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </div>
                        <div class="feed-item__additional-photos">
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ Vite::image('621_2.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ Vite::image('621_3.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ Vite::image('621_2.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ Vite::image('621_3.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>


                        </div>

                        <x-ui.message type="warning">
                            <x-slot:icon class="message__icon_warning">
                                <x-svg.warning class="message__warning-icon"></x-svg.warning>
                            </x-slot:icon>
                            Администрация сайта не имеет отношения к товарам и услугам продаваемым на сайте. Будьте предельно внимательны при общении с продавцами и проводите сделку только при полной уверенности в продавце
                        </x-ui.message>

                    </div>
                    <div class="feed-item__info">
                        <x-ui.title indent="normal">BLES00789, Resonance of Fate, Playstation 3</x-ui.title>

                        <div class="sale-item__main">
                            <div class="sale-item__price">
                                <div class="sale-item__price-title">Цена:</div>
                                <x-ui.tag class="sale-item__price-data" color="success" disabled="true">
                                    <span class="sale-item__price-value">2500</span>
                                    <span class="sale-item__currency">RUB</span>
                                    <div class="sale-item__price-discount">-20%</div>
                                </x-ui.tag>
                                <x-ui.tag class="sale-item__price-data" color="dark" disabled="true">
                                    <span class="sale-item__price-oldvalue">3000</span>
                                    <span class="sale-item__currency">RUB</span>
                                </x-ui.tag>
                            </div>

                            <div class="author-info sale-item__author">
                                <div class="author-info__main">
                                    <div class="author-info__thumbnail">
                                        <a href=""><img class="author-info__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                                    </div>
                                    <div class="author-info__content">
                                        <div class="author-info__name"><a href="">Ивановіваффіва Иван</a></div>
                                        <div class="author-info__nickname"><a href="">@test-user</a></div>
                                    </div>
                                </div>
                                <div class="author-info__rating">
                                    <div class="author-info__rating-title">Рейтинг</div>
                                    <div class="author-info__rating-value"><a href="">9.5/10</a></div>
                                </div>
                            </div>
                        </div>





<x-ui.card class="sale-item__specifications" color="dark">

    <div class="sale-item__specifications-wrapper">
        <x-grid type="container">
            <x-grid.col xl="6" lg="6" md="6" sm="12">



                <x-ui.specifications>

                    <x-ui.specifications.item title="Состояние">
                        <x-ui.tag>Б/У</x-ui.tag>
                    </x-ui.specifications.item>

                    <x-ui.specifications.item title="Торг">
                        <x-ui.tag>Возможен</x-ui.tag>
                    </x-ui.specifications.item>

                    <x-ui.specifications.item title="Доставка">
                        <x-ui.tag>По всему миру</x-ui.tag>
                    </x-ui.specifications.item>

                    <x-ui.specifications.item title="Самовывоз">
                        <x-ui.tag>Москва</x-ui.tag>
                    </x-ui.specifications.item>

                    <x-ui.specifications.item title="Бронь">
                        <x-ui.tag>По предоплате</x-ui.tag>
                    </x-ui.specifications.item>


                </x-ui.specifications>
            </x-grid.col>



            <x-grid.col xl="6" lg="6" md="6" sm="12">

                <x-ui.star-rating
                    class="sale-item__star-rating"
                    type="disabled"
                    title="Диск"
                    num-class="10"
                    name="disk">
                </x-ui.star-rating>



                <x-ui.star-rating
                    class="sale-item__star-rating"
                    type="disabled"
                    value="9"
                    title="Мануал"
                    num-class="10"
                    name="manual">
                </x-ui.star-rating>



                <x-ui.star-rating
                    class="sale-item__star-rating"
                    type="disabled"
                    title="Коробка"
                    value="none"
                    num-class="10"
                    name="box">
                </x-ui.star-rating>


                <x-ui.star-rating
                    class="sale-item__star-rating"
                    title="Обложка"
                    type="disabled"
                    value="5"
                    num-class="10"
                    name="cover">
                </x-ui.star-rating>

            </x-grid.col>
        </x-grid>
    </div>


    <div class="sale-item__description">
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
        </p>
    </div>
<div class="sale-item__buttons">
    <x-ui.form.button>Купить</x-ui.form.button>
    <x-ui.form.button>Забронировать</x-ui.form.button>
    <x-ui.form.button color="info">Написать продавцу</x-ui.form.button>
    <x-ui.form.button
        title="{{ __('Добавить в список желаний') }}"
        size="big"
        color="light"
        only-icon="true">
        <x-slot:icon class="button__icon-wrapper_cancel">
            <x-svg.wishlist class="button__icon button__icon_small"></x-svg.wishlist>
        </x-slot:icon>
    </x-ui.form.button>
    <x-ui.form.button
        title="{{ __('Добавить в избранное') }}"
        size="big"
        color="light"
        only-icon="true">
        <x-slot:icon class="button__icon-wrapper_cancel">
            <x-svg.star class="button__icon button__icon_small"></x-svg.star>
        </x-slot:icon>
    </x-ui.form.button>
</div>



</x-ui.card>

                        <x-ui.specifications>
                            <x-ui.specifications.item title="Языки">
                                Английский, Русский, Французский, Японский, Испанский
                            </x-ui.specifications.item>
                            <x-ui.specifications.item type="inline" title="Платформа">
                                <x-ui.tag color="dark">Playstation 3</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item type="inline" title="Код игры">
                                <x-ui.tag color="dark">BLES00789</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item type="inline" title="Жанр">
                                <x-ui.tag color="dark">Платформер</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item type="inline" title="Тип издания">
                                <x-ui.tag color="dark">Classic</x-ui.tag>
                            </x-ui.specifications.item>
                        </x-ui.specifications>

                        <div class="feed-item__links">
                            <x-ui.form.button tag="a" link="{{ route('game-carrier') }}" color="info">Подробнее об издании</x-ui.form.button>
                        </div>

                    </div>
                </div>
            </x-ui.card>

        </x-common.content>
    </x-grid.container>

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
        </script>
    @endpush
</x-layouts.main>

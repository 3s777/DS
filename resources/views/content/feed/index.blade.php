<x-layouts.main title="Feed">
    <x-grid.container>
        <x-common.content class="feed">
            <x-common.messages />


                <x-content.item.card class="card feed-item sale-item">
                    <x-slot:photos>
                        <x-content.item.photos>
                            <x-slot:main-photo>
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('620_1.jpg') }}"
                                    src_full="{{ Vite::image('620_1.jpg') }}" />
                            </x-slot:main-photo>

                            <x-slot:additional-photos>
                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_2.jpg') }}"
                                        src_full="{{ Vite::image('621_2.jpg') }}" />
                                </div>

                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_3.jpg') }}"
                                        src_full="{{ Vite::image('621_3.jpg') }}" />
                                </div>

                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_2.jpg') }}"
                                        src_full="{{ Vite::image('621_2.jpg') }}" />
                                </div>

                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_3.jpg') }}"
                                        src_full="{{ Vite::image('621_3.jpg') }}" />
                                </div>
                            </x-slot:additional-photos>

                            <x-ui.message type="warning">
                                <x-slot:icon class="message__icon_warning">
                                    <x-svg.warning class="message__warning-icon"></x-svg.warning>
                                </x-slot:icon>
                                Администрация сайта не имеет отношения к товарам и услугам продаваемым на сайте. Будьте предельно внимательны при общении с продавцами и проводите сделку только при полной уверенности в продавце
                            </x-ui.message>

                        </x-content.item.photos>
                    </x-slot:photos>

                    <x-slot:info>
                        <x-ui.title indent="normal">BLES00789, Resonance of Fate, Playstation 3</x-ui.title>

                        <x-content.item.main class="sale-item__main">
                            <div class="sale-item__price">
                                <div class="sale-item__price-title">Цена:</div>
                                <x-ui.price
                                    class="sale-item__price-data"
                                    color="success"
                                    value="2500"
                                    currency="RUB"
                                    discount="20"/>
                                <x-ui.price
                                    class="sale-item__price-data"
                                    color="dark"
                                    value="3000"
                                    currency="RUB"
                                    old="true"/>
                            </div>

                            <x-content.author-info
                                class="sale-item__author"
                                photo="{{ Vite::image('620_1.jpg') }}"
                                name="Иванов Иван Иванович"
                                username="test-user"
                                rating="8">
                            </x-content.author-info>
                        </x-content.item.main>

                        <x-content.item.specifications class="card card_color_dark">
                            <x-slot:specifications>
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
                            </x-slot:specifications>
                            <x-slot:starRating>
                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    type="disabled"
                                    value="10"
                                    title="Диск"
                                    num-class="10"
                                    name="disk-1">
                                </x-ui.star-rating>

                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    type="disabled"
                                    value="9"
                                    title="Мануал"
                                    num-class="10"
                                    name="manual-1">
                                </x-ui.star-rating>

                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    type="disabled"
                                    title="Коробка"
                                    value="3"
                                    num-class="10"
                                    name="box-1">
                                </x-ui.star-rating>

                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    title="Обложка"
                                    type="disabled"
                                    value="8"
                                    num-class="10"
                                    name="cover-1">
                                </x-ui.star-rating>
                            </x-slot:starRating>
                            <x-slot:description>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                </p>
                            </x-slot:description>
                            <x-slot:buttons>
                                <x-ui.form.button class="item-specifications__button">Купить</x-ui.form.button>
                                <x-ui.form.button class="item-specifications__button">Забронировать</x-ui.form.button>
                                <x-ui.form.button class="item-specifications__button" color="info">Написать продавцу</x-ui.form.button>
                            </x-slot:buttons>
                        </x-content.item.specifications>

                        <x-content.item.additional-info>
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
                        </x-content.item.additional-info>
                    </x-slot:info>
                </x-content.item.card>


                <x-content.item.card class="card feed-item auction-item">
                    <x-slot:photos>
                        <x-content.item.photos>
                            <x-slot:main-photo>
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('620_1.jpg') }}"
                                    src_full="{{ Vite::image('620_1.jpg') }}" />
                            </x-slot:main-photo>

                            <x-slot:additional-photos>
                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_2.jpg') }}"
                                        src_full="{{ Vite::image('621_2.jpg') }}" />
                                </div>

                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_3.jpg') }}"
                                        src_full="{{ Vite::image('621_3.jpg') }}" />
                                </div>

                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_2.jpg') }}"
                                        src_full="{{ Vite::image('621_2.jpg') }}" />
                                </div>

                                <div class="item-photos__additional-photo">
                                    <x-ui.image
                                        class="item-photos__img"
                                        caption="Test Caption"
                                        src="{{ Vite::image('621_3.jpg') }}"
                                        src_full="{{ Vite::image('621_3.jpg') }}" />
                                </div>
                            </x-slot:additional-photos>

                            <x-ui.message type="warning">
                                <x-slot:icon class="message__icon_warning">
                                    <x-svg.warning class="message__warning-icon"></x-svg.warning>
                                </x-slot:icon>
                                Администрация сайта не имеет отношения к товарам и услугам продаваемым на сайте. Будьте предельно внимательны при общении с продавцами и проводите сделку только при полной уверенности в продавце
                            </x-ui.message>

                        </x-content.item.photos>
                    </x-slot:photos>

                    <x-slot:info>
                        <x-ui.title indent="normal">BLES00789, Resonance of Fate, Playstation 3</x-ui.title>

                        <x-content.item.main class="auction-item__main">

                            <div class="auction-item__terms">
                                <div class="auction-item__bids">
                                    <div class="sale-item__price-title">Начальная ставка:</div>
                                    <x-ui.tag class="sale-item__price-data" color="dark" disabled="true">
                                        <span class="sale-item__price-value">2500</span>
                                        <span class="sale-item__currency">RUB</span>
                                    </x-ui.tag>
                                    <div class="sale-item__price-title">Текущая ставка:</div>
                                    <x-ui.tag class="sale-item__price-data" color="success" disabled="true">
                                        <span class="sale-item__price-oldvalue">3000</span>
                                        <span class="sale-item__currency">RUB</span>
                                    </x-ui.tag>
                                    <div class="sale-item__price-title">Блиц ставка:</div>
                                    <x-ui.tag class="sale-item__price-data" color="dark" disabled="true">
                                        <span class="sale-item__price-oldvalue">5000</span>
                                        <span class="sale-item__currency">RUB</span>
                                    </x-ui.tag>
                                </div>
                                <div class="auction-item__rules">
                                    <div class="sale-item__price-title">Шаг ставки:</div>
                                    <x-ui.tag class="sale-item__price-data" color="dark" disabled="true">
                                        <span class="sale-item__price-value">50</span>
                                    </x-ui.tag>
                                    <div class="sale-item__price-title">Дата окончания:</div>
                                    <x-ui.tag class="sale-item__price-data" color="dark" disabled="true">
                                        <span class="sale-item__price-value">20:00 12.12.2023</span>
                                    </x-ui.tag>
                                    <div class="sale-item__price-title">Автопродление:</div>
                                    <x-ui.tag class="sale-item__price-data" color="dark" disabled="true">
                                        <span class="sale-item__price-value">3 минуты</span>
                                    </x-ui.tag>
                                </div>
                            </div>

                            <x-content.author-info
                                class="auction-item__author"
                                photo="{{ Vite::image('620_1.jpg') }}"
                                name="Иванов Иван Иванович"
                                username="test-user"
                                rating="8">
                            </x-content.author-info>
                        </x-content.item.main>

                        <x-content.item.specifications class="card card_color_dark">
                            <x-slot:specifications>
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
                            </x-slot:specifications>
                            <x-slot:starRating>
                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    type="disabled"
                                    value="10"
                                    title="Диск"
                                    num-class="10"
                                    name="disk-1">
                                </x-ui.star-rating>

                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    type="disabled"
                                    value="9"
                                    title="Мануал"
                                    num-class="10"
                                    name="manual-1">
                                </x-ui.star-rating>

                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    type="disabled"
                                    title="Коробка"
                                    value="3"
                                    num-class="10"
                                    name="box-1">
                                </x-ui.star-rating>

                                <x-ui.star-rating
                                    class="item-specifications__star-rating"
                                    title="Обложка"
                                    type="disabled"
                                    value="8"
                                    num-class="10"
                                    name="cover-1">
                                </x-ui.star-rating>
                            </x-slot:starRating>
                            <x-slot:description>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                </p>
                            </x-slot:description>
                            <x-slot:buttons>
                                <x-ui.form.button class="item-specifications__button">Купить</x-ui.form.button>
                                <x-ui.form.button class="item-specifications__button">Забронировать</x-ui.form.button>
                                <x-ui.form.button class="item-specifications__button" color="info">Написать продавцу</x-ui.form.button>
                            </x-slot:buttons>
                        </x-content.item.specifications>

                        <x-content.item.additional-info>
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
                        </x-content.item.additional-info>
                    </x-slot:info>
                </x-content.item.card>


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



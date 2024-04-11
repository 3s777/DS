<x-layouts.main title="Feed">
    <x-grid.container>
        <x-common.content class="feed">
            <x-common.messages />


            <x-content.item.card class="feed-item sale-item">
                <x-slot:photos>
                    <x-content.item.photos>
                        <x-slot:main-photo>
                            <x-ui.image
                                class="item-photos__img"
                                caption="Test Caption"
                                src="{{ Vite::image('620_1.jpg') }}"
                                src-full="{{ Vite::image('620_1.jpg') }}" />
                        </x-slot:main-photo>

                        <x-slot:additional-photos>
                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_2.jpg') }}"
                                    src-full="{{ Vite::image('621_2.jpg') }}" />
                            </div>

                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_3.jpg') }}"
                                    src-full="{{ Vite::image('621_3.jpg') }}" />
                            </div>

                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_2.jpg') }}"
                                    src-full="{{ Vite::image('621_2.jpg') }}" />
                            </div>

                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_3.jpg') }}"
                                    src-full="{{ Vite::image('621_3.jpg') }}" />
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
                                class="sale-item__price-value"
                                color="success"
                                value="2500"
                                currency="RUB"
                                discount="20"/>
                            <x-ui.price
                                class="sale-item__price-value"
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

                    <x-content.item.specifications>
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
                                src-full="{{ Vite::image('620_1.jpg') }}" />
                        </x-slot:main-photo>

                        <x-slot:additional-photos>
                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_2.jpg') }}"
                                    src-full="{{ Vite::image('621_2.jpg') }}" />
                            </div>

                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_3.jpg') }}"
                                    src-full="{{ Vite::image('621_3.jpg') }}" />
                            </div>

                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_2.jpg') }}"
                                    src-full="{{ Vite::image('621_2.jpg') }}" />
                            </div>

                            <div class="item-photos__additional-photo">
                                <x-ui.image
                                    class="item-photos__img"
                                    caption="Test Caption"
                                    src="{{ Vite::image('621_3.jpg') }}"
                                    src-full="{{ Vite::image('621_3.jpg') }}" />
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

                        <div class="auction-item__bids">
                            <x-ui.title size="small" class="auction-item__bids-title">Ставки:</x-ui.title>
                            <div class="auction-item__bids-wrapper">
                                <div class="auction-item__bid">
                                    <x-ui.price
                                        class="auction-item__price"
                                        prefix="auction-item"
                                        color="dark"
                                        value="300"
                                        currency="RUB"/>
                                    <div class="auction-item__bid-title">Стартовая</div>
                                </div>

                                <div class="auction-item__bid">

                                    <x-ui.price
                                        class="auction-item__price"
                                        prefix="auction-item"
                                        color="success"
                                        value="2500"
                                        currency="RUB"/>
                                    <div class="auction-item__bid-title">Текущая</div>
                                </div>

                                <div class="auction-item__bid">
                                    <x-ui.price
                                        class="auction-item__price"
                                        prefix="auction-item"
                                        color="dark"
                                        value="10000"
                                        currency="RUB"/>
                                    <div class="auction-item__bid-title">Блиц</div>
                                </div>

                                <div class="auction-item__bid">
                                    <x-ui.price
                                        class="auction-item__price"
                                        prefix="auction-item"
                                        color="danger"
                                        value="1000"
                                        currency="RUB"/>
                                    <div class="auction-item__bid-title">Ваша</div>
                                </div>

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

                    <div class="auction-item__rules">
                        <x-ui.title size="small" class="auction-item__bids-title">Условия аукциона:</x-ui.title>
                        <x-ui.specifications>
                            <x-ui.specifications.item
                                class="auction-item__rule"
                                type="inline"
                                title="Шаг">
                                <x-ui.tag class="auction-item__rule-value" color="dark" disabled="true">
                                    50
                                </x-ui.tag>
                            </x-ui.specifications.item>

                            <x-ui.specifications.item
                                class="auction-item__rule"
                                type="inline"
                                title="Окончание">
                                <x-ui.tag class="auction-item__rule-value" color="dark" disabled="true">
                                    20:00 12.12.2023
                                </x-ui.tag>
                            </x-ui.specifications.item>

                            <x-ui.specifications.item
                                class="auction-item__rule"
                                type="inline"
                                title="Автопродление">
                                <x-ui.tag class="auction-item__rule-value" color="dark" disabled="true">
                                    3 минуты
                                </x-ui.tag>
                            </x-ui.specifications.item>
                        </x-ui.specifications>
                    </div>

                    <form class="auction-item__bid-form" action="" >
                        <x-ui.form.input-text name="bid" id="bid" placeholder="Ваша ставка" type="number" step="50" min="300"></x-ui.form.input-text>
                        <x-ui.form.button class="auction-item__bid-button">Сделать ставку</x-ui.form.button>
                        <x-ui.form.button>Купить</x-ui.form.button>
                    </form>

                    <div class="auction-item__bids-history">
                        <x-ui.accordion>
                            <x-ui.accordion.item class="auction-item__accordion" color="light">
                                <x-ui.accordion.title class="auction-item__history-title">История ставок</x-ui.accordion.title>
                                <x-ui.accordion.content>
                                    <div class="auction-item__history-list">
                                        <div class="auction-item__bid-row">
                                            <div class="auction-item__bid-info">
                                                <x-ui.tag class="auction-item__bid-username" color="dark">@i.sinica</x-ui.tag>
                                                <div class="auction-item__bid-value">500<span class="auction-item__bid-currency">RUB</span></div>
                                            </div>
                                            <div class="auction-item__bid-date">10:47 14.12.2023</div>
                                        </div>
                                        <div class="auction-item__bid-row">
                                            <div class="auction-item__bid-info">
                                                <x-ui.tag class="auction-item__bid-username" color="dark">@test.user</x-ui.tag>
                                                <div class="auction-item__bid-value">400<span class="auction-item__bid-currency">RUB</span></div>
                                            </div>
                                            <div class="auction-item__bid-date">22:34 13.12.2023</div>
                                        </div>
                                        <div class="auction-item__bid-row">
                                            <div class="auction-item__bid-info">
                                                <x-ui.tag class="auction-item__bid-username" color="dark">@game.collector</x-ui.tag>
                                                <div class="auction-item__bid-value">300<span class="auction-item__bid-currency">RUB</span></div>
                                            </div>
                                            <div class="auction-item__bid-date">8:01 12.12.2023</div>
                                        </div>
                                    </div>
                                </x-ui.accordion.content>
                            </x-ui.accordion.item>
                        </x-ui.accordion>
                    </div>

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
                                name="disk-2">
                            </x-ui.star-rating>

                            <x-ui.star-rating
                                class="item-specifications__star-rating"
                                type="disabled"
                                value="9"
                                title="Мануал"
                                num-class="10"
                                name="manual-2">
                            </x-ui.star-rating>

                            <x-ui.star-rating
                                class="item-specifications__star-rating"
                                type="disabled"
                                title="Коробка"
                                value="3"
                                num-class="10"
                                name="box-2">
                            </x-ui.star-rating>

                            <x-ui.star-rating
                                class="item-specifications__star-rating"
                                title="Обложка"
                                type="disabled"
                                value="5"
                                num-class="10"
                                name="cover-2">
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



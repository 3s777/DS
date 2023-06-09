@extends('layouts.auth')

@section('title', __('Game Carrier'))

@section('content')
<div class="container">
    <div class="content carrier">
        <div class="content__title">
            <x-ui.title tag="h1" size="large" >
                {{ __('Resonance of Fate') }}
            </x-ui.title>
            <div class="content__title-tags carrier__title-tags">
                <x-ui.tag href="/">Playstation 3</x-ui.tag>
                <x-ui.tag href="">BLES00789</x-ui.tag>
                <x-ui.tag indent="" href="">BLUS30484</x-ui.tag>
            </div>
        </div>
        <x-grid type="container">
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.card indent_bottom="true">
                    <a href="{{ asset('/storage/test.jpg') }}" data-fancybox data-caption="Single image">
                        <picture class="image">
                            <source
                                type="image/webp"
                                srcset="
                                        {{ asset('/storage/test-300.webp') }} 300w,
                                        {{ asset('/storage/test-650.webp') }} 650w,
                                        {{ asset('/storage/test-800.webp') }} 800w,
                                        {{ asset('/storage/test-1200.webp') }} 1200w,
                                        {{ asset('/storage/test-1500.webp') }} 1500w,
                                        {{ asset('/storage/test.webp') }} 3000w,
                                    "
                                sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                            />
                            <img
                                src="{{ asset('/storage/test.jpg') }}"
                                srcset="
                                        {{ asset('/storage/test-300.jpg') }} 300w,
                                        {{ asset('/storage/test-650.jpg') }} 650w,
                                        {{ asset('/storage/test-800.jpg') }} 800w,
                                        {{ asset('/storage/test-1200.jpg') }} 1200w,
                                        {{ asset('/storage/test-1jpg') }} 1500w,
                                        {{ asset('/storage/test.jpg') }} 3000w,
                                    "
                                sizes="
                                        (max-width: 700px) 280px,
                                        (max-width: 1000px) 740px,
                                        (max-width: 1900px) 1500px,
                                        100vw
                                    "
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </picture>
                    </a>
                </x-ui.card>
            </x-grid.col>
            <x-grid.col lg="6" xl="6" md="6" sm="12">
                <x-ui.card indent_bottom="true">
                    <div class="carrier__add">
                        <div class="carrier__add-buttons">
                            <x-libraries.choices
                                class="choices-select-1"
                                wrapper_class="choices-block_color_success carrier__add-select"
                                id="select-test"
                                name="select-test"
                                show_label=""
                                color="additional"
                                label="На полку">
                                <x-ui.form.option>Добавить</x-ui.form.option>
                                <x-ui.form.option value="1">В коллекцию</x-ui.form.option>
                                <x-ui.form.option value="2">Продать</x-ui.form.option>
                                <x-ui.form.option value="3">Аукцион</x-ui.form.option>
                                <x-ui.form.option value="4">Обменять</x-ui.form.option>
                                <x-ui.form.option value="6">Список желаний</x-ui.form.option>
                                <x-ui.form.option value="7">Создать пост</x-ui.form.option>
                                <x-ui.form.option value="8">Избранное</x-ui.form.option>
                            </x-libraries.choices>

                            <x-ui.form.button
                                color="dark"
                                only_icon="true"
                                title="Добавить в коллекцию">
                                <x-slot:icon>
                                    <x-svg.check class="button__icon button__icon_big button__check-icon"></x-svg.check>
                                </x-slot:icon>
                            </x-ui.form.button>

                            <x-ui.form.button
                                color="dark"
                                only_icon="true"
                                title="Продать">
                                <x-slot:icon>
                                    <x-svg.dollar class="button__icon button__icon_big button__dollar-icon"></x-svg.dollar>
                                </x-slot:icon>
                            </x-ui.form.button>

                            <x-ui.form.button
                                color="dark"
                                only_icon="true"
                                title="Выставить на аукцион">
                                <x-slot:icon>
                                    <x-svg.auction class="button__icon button__icon_big button__auction-icon"></x-svg.auction>
                                </x-slot:icon>
                            </x-ui.form.button>

                            <x-ui.form.button
                                color="dark"
                                only_icon="true"
                                title="Обменять">
                                <x-slot:icon>
                                    <x-svg.exchange class="button__icon button__icon_big button__exchange-icon"></x-svg.exchange>
                                </x-slot:icon>
                            </x-ui.form.button>

                            <x-ui.form.button
                                color="dark"
                                only_icon="true"
                                title="Добавить в список желаемого">
                                <x-slot:icon>
                                    <x-svg.whishlist class="button__icon button__icon_big button__whishlist-icon"></x-svg.whishlist>
                                </x-slot:icon>
                            </x-ui.form.button>

                            <x-ui.form.button
                                color="dark"
                                only_icon="true"
                                title="Добавить публикацию">
                                <x-slot:icon>
                                    <x-svg.edit class="button__icon button__icon_big button__edit-icon"></x-svg.edit>
                                </x-slot:icon>
                            </x-ui.form.button>

                            <x-ui.form.button
                                color="dark"
                                only_icon="true"
                                title="Добавить в избранное">
                                <x-slot:icon>
                                    <x-svg.star class="button__icon button__icon_big button__star-icon"></x-svg.star>
                                </x-slot:icon>
                            </x-ui.form.button>
                        </div>
                        <div class="carrier__add-form">
                            <x-ui.title indent="small">Добавить в коллекцию</x-ui.title>
                            <x-grid type="container">
                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.choices
                                            class="choices-select-shelf"
                                            id="select-test"
                                            name="select-test"
                                            label="Выберите полку">
                                            <x-ui.form.option value="1">Стандартная полка</x-ui.form.option>
                                            <x-ui.form.option value="2">Полка третья</x-ui.form.option>
                                        </x-libraries.choices>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.input-text
                                            :errors="$errors"
                                            placeholder="Количество"
                                            id="text"
                                            name="text"
                                            value="{{ old('text') }}"
                                            required
                                            autocomplete="on">
                                        </x-ui.form.input-text>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.input-text
                                            :errors="$errors"
                                            placeholder="Свой артикул"
                                            id="text"
                                            name="text"
                                            value="{{ old('text') }}"
                                            required
                                            autocomplete="on">
                                        </x-ui.form.input-text>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.input-text
                                            :errors="$errors"
                                            placeholder="Цена покупки"
                                            id="text"
                                            name="text"
                                            value="{{ old('text') }}"
                                            type="number"
                                            required
                                            autocomplete="on">
                                        </x-ui.form.input-text>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col xl="6" lg="6" md="12" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.star-rating
                                            class="carrier__add-rating"
                                            title="Диск"
                                            name="disk">
                                        </x-ui.star-rating>

                                    </x-ui.form.group>
                                </x-grid.col>

                                <x-grid.col xl="6" lg="6" md="12" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.star-rating
                                            class="carrier__add-rating"
                                            title="Мануал"
                                            name="manual">
                                        </x-ui.star-rating>

                                    </x-ui.form.group>
                                </x-grid.col>


                                <x-grid.col xl="6" lg="6" md="12" sm="12">
                                    <x-ui.form.group>


                                        <x-ui.star-rating
                                            class="carrier__add-rating"
                                            title="Коробка"
                                            name="box">
                                        </x-ui.star-rating>
                                    </x-ui.form.group>
                                </x-grid.col>


                            </x-grid>


                        </div>
                    </div>
                </x-ui.card>
                <x-ui.card indent_bottom="true">
                <x-grid type="container">
                    <x-grid.col xl="12" lg="12" md="12" sm="12">
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

                        <x-ui.message type="info" >
                            <x-slot:icon class="message__icon_info">
                                <x-svg.info class="message__info-icon"></x-svg.info>
                            </x-slot:icon>
                            Мы не можем гарантировать что все данные указаны верно. Мы берем информацию из открытых источников и работаем крайне ограниченным кругом лиц. Мы будем очень рады любым дополнения, исправлениям, уточнениям с вашей стороны. Если вы хотите дополнить информацию вы можете нажать здесь и написать нам. Мы будем благодарны любой вашей помощи в наполнении данного сайта
                        </x-ui.message>
                    </x-grid.col>
                </x-grid>
                </x-ui.card>


            </x-grid.col>
        </x-grid>
    </div>
</div>
@endsection

@push('scripts')
    <script type="module">
        const element1 = document.querySelector('.choices-select-1');
        const choices1 = new Choices(element1, {
            itemSelectText: '',
            searchEnabled: false,
            noResultsText: '{{ __('Не найдено') }}',
            noChoicesText: '{{ __('Больше ничего нет') }}',
        });

        const element2 = document.querySelector('.choices-select-shelf');
        const choices2 = new Choices(element2, {
            itemSelectText: '',
            searchEnabled: false,
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



    </script>


@endpush

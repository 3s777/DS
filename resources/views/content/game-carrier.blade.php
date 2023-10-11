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
                    <x-libraries.swiper type="full" class="carrier__swiper-main">

                        <x-libraries.swiper.slide >
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide class="ui__test-swiper-slide">
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-2.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide class="ui__test-swiper-slide">
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-3.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide class="ui__test-swiper-slide">
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-4.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide class="ui__test-swiper-slide">
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-5.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>

                        <x-slot:pagination class="swiper-pagination_2"></x-slot:pagination>
                        <x-slot:navigation></x-slot:navigation>

                    </x-libraries.swiper>

                    <x-libraries.swiper class="swiper">

                        <x-libraries.swiper.slide>
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide>
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-2.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide>
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-3.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide>
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-4.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>
                        <x-libraries.swiper.slide>
                            <img
                                class="swiper__img"
                                src="{{ asset('/storage/test-5.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </x-libraries.swiper.slide>

                        <x-slot:pagination class="swiper-pagination_1"></x-slot:pagination>
                        <x-slot:navigation>1</x-slot:navigation>

                    </x-libraries.swiper>


                </x-ui.card>

                <x-ui.card>
                    <x-ui.comments count="4">
                        <x-ui.comments.comment
                            class="test-class"
                            username="@i.sinica"
                            avatar_url="{{ asset('/storage/test-5.jpg') }}"
                            user_link="{{ route('ui') }}"
                            date="09.10.2023 10:43"
                            likes_count="13"
                            likes_status="active"
                        >
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                                commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                                mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                                totam voluptates.</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                                commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                                mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                                totam voluptates.</p>
                        </x-ui.comments.comment>

                        <x-ui.comments.comment
                            class="test-class"
                            type="answer"
                            username="Администратор сообщества"
                            avatar_url="{{ asset('/storage/test.jpg') }}"
                            user_link="{{ route('ui') }}"
                            date="10.10.2024 15:10"
                            likes_count="5"
                            likes_status="active"
                        >
                            <p>Lorem</p>
                        </x-ui.comments.comment>

                        <x-ui.comments.comment
                            class="test-class"
                            type="answer"
                            color="author"
                            username="Администратор сообщества"
                            avatar_url="{{ asset('/storage/test.jpg') }}"
                            user_link="{{ route('ui') }}"
                            date="10.10.2024 15:10"
                            likes_count="5"
                            likes_status="active"
                        >
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                                commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                                mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                                totam voluptates.</p>
                        </x-ui.comments.comment>

                        <x-ui.comments.comment
                            class="test-class"
                            username="@i.sinica"
                            avatar_url="{{ asset('/storage/test-5.jpg') }}"
                            user_link="{{ route('ui') }}"
                            date="09.10.2023 10:43"
                            likes_count="13"
                            likes_status="active"
                        >
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                                commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                                mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                                totam voluptates.</p>

                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aspernatur
                                commodi, dignissimos eos, eum incidunt inventore labore laboriosam
                                mollitia nostrum optio, quae qui quis quos repellat tempora tempore
                                totam voluptates.</p>
                        </x-ui.comments.comment>
                    </x-ui.comments>
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
                            <x-ui.title indent="normal">Добавить в коллекцию</x-ui.title>
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
                                        <x-libraries.choices
                                            class="choices-select-state"
                                            id="select-test-state"
                                            name="select-test-state"
                                            label="Состояние">
                                            <x-ui.form.option value="1">Б/У</x-ui.form.option>
                                            <x-ui.form.option value="2">Новый (силд)</x-ui.form.option>
                                            <x-ui.form.option value="3">Перепак</x-ui.form.option>
                                            <x-ui.form.option value="4">Промо</x-ui.form.option>
                                            <x-ui.form.option value="5">Кастом</x-ui.form.option>
                                        </x-libraries.choices>
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

                                <x-grid.col xl="6" lg="6" md="12" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.star-rating
                                            class="carrier__add-rating"
                                            title="Обложка"
                                            name="cover">
                                        </x-ui.star-rating>
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

                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.input-text
                                            :errors="$errors"
                                            placeholder="Место покупки"
                                            id="text"
                                            name="text"
                                            value="{{ old('text') }}"
                                            required
                                            autocomplete="on">
                                        </x-ui.form.input-text>
                                    </x-ui.form.group>
                                </x-grid.col>


                                <x-grid.col xl="6" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.datepicker
                                            :errors="$errors"
                                            id="date"
                                            name="date"
                                            placeholder="Дата покупки"
                                            value="{{ old('date') }}"
                                            required>
                                        </x-ui.form.datepicker>
                                    </x-ui.form.group>
                                </x-grid.col>

                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.choices
                                            class="choices-select-box"
                                            id="select-test-box"
                                            name="select-test-box"
                                            label="Тип бокса">
                                            <x-ui.form.option value="">Не указывать</x-ui.form.option>
                                            <x-ui.form.option value="1">Red Label</x-ui.form.option>
                                            <x-ui.form.option value="2">Black Label</x-ui.form.option>
                                            <x-ui.form.option value="3">Black Label Мягкий</x-ui.form.option>
                                            <x-ui.form.option value="4">Промо</x-ui.form.option>
                                            <x-ui.form.option value="5">Blue Ray</x-ui.form.option>
                                        </x-libraries.choices>
                                    </x-ui.form.group>
                                </x-grid.col>

                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.input-text
                                            :errors="$errors"
                                            placeholder="Свое поле"
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
                                            placeholder="Свое поле"
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
                                        <x-ui.form.switcher
                                            name="switcher1"
                                            label="{{ __('Игра пройдена') }}"
                                        >
                                        </x-ui.form.switcher>
                                    </x-ui.form.group>
                                </x-grid.col>

                                <x-grid.col lg="6" xl="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.switcher
                                            name="switcher2"
                                            label="{{ __('Наличие цифровой версии') }}"
                                        >
                                        </x-ui.form.switcher>
                                    </x-ui.form.group>
                                </x-grid.col>

                                <x-grid.col xl="6" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.filepond
                                            class="filepond1"
                                            name="filepond"
                                            accept="image/png, image/jpeg, image/gif"
                                            multiple>
                                        </x-libraries.filepond>
                                    </x-ui.form.group>
                                </x-grid.col>
                                <x-grid.col xl="6" lg="6" md="6" sm="12">
                                    <x-ui.form.group>
                                        <x-libraries.filepond
                                            class="filepond2"
                                            name="filepond"
                                            multiple
                                            data-allow-reorder="true"
                                            data-max-file-size="3MB"
                                            data-max-files="3">
                                        </x-libraries.filepond>
                                    </x-ui.form.group>
                                </x-grid.col>

                                <x-grid.col lg="12" xl="12" md="12" sm="12">
                                    <x-ui.form.group>
                                        <x-ui.form.textarea
                                            :errors="$errors"
                                            id="textarea"
                                            name="textarea"
                                            placeholder="{{ __('Заметки и коментарии') }}">
                                            {{ old('textarea') }}
                                        </x-ui.form.textarea>
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

        const swiper = new Swiper('.swiper__carousel', {
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

        var quill = new Quill('#new-comment', {
            placeholder: 'Leave your comment',
            theme: 'snow'
        });
    </script>


@endpush

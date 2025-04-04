<x-layouts.main title="{{ __('user.collector.list') }}" :search="false">
    <div class="collector-search__form">
        <x-grid.container>
            <x-ui.input-search
                wrapper-class="collector-search__form-input"
                link="{{ route('collectors') }}"
                placeholder="{{ __('user.collector.enter_name') }}">
            </x-ui.input-search>
        </x-grid.container>
    </div>

    <x-grid.container>
        <x-common.content>
            <div class="collector-search__title">
                <x-ui.title size="big">
                    {{ __('user.collector.list') }}
                </x-ui.title>
            </div>

            <div class="collector-search__list">
                @foreach($collectors as $collector)
                    <x-ui.card class="collector-preview collector-search__preview" size="small">
                        <a href="" class="collector-preview__rating" title="Рейтинг пользователя">9.5/10</a>
                        <div class="collector-preview__item">
                            <div class="collector-preview__main">
                                @if($collector->getFeaturedImagePath())
                                    <div class="collector-preview__avatar">
                                        <a href="">
                                            <x-ui.responsive-image
                                                class="collector-preview__img"
                                                :model="auth('collector')->user()"
                                                :image-sizes="['extra_small', 'small']"
                                                :path="$collector->getFeaturedImagePath()"
                                                :placeholder="true"
                                                width="100"
                                                height="100"
                                                sizes="(max-width: 768px) 100px, (max-width: 1200px) 80px, 100px">
                                                <x-slot:img alt="test" title="test title"></x-slot:img>
                                            </x-ui.responsive-image>
                                        </a>
                                    </div>
                                @endif
                                <div class="collector-preview__info">
                                    <div class="collector-preview__name"><a href="">{{ $collector->first_name }}</a></div>
                                    <div class="collector-preview__nickname">
                                        <a href="">{{ '@'.$collector->name }}</a>
                                    </div>
                                    <div class="collector-preview__subscribe">
                                        <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                        <x-ui.form.button class="collector-preview__button-message" tag="a" href="{{ route('collectors') }}" only-icon="true" size="small" title="Написать сообщение">
                                            <x-svg.message class="collector-preview__message-icon"></x-svg.message>
                                        </x-ui.form.button>
                                    </div>
                                </div>
                            </div>

                            <x-common.counter-buttons
                                type="light"
                                class="collector-preview__buttons collector-search__preview-buttons"
                                button-class="collector-preview__button collector-search__preview-button"
                                badge-class="collector-preview__badge collector-search__preview-badge"
                                add="12"
                                wishlist="50"
                                sale="5"
                                auction="25"
                                exchange="2"
                            />
                        </div>
                    </x-ui.card>
                @endforeach

                <x-ui.card class="collector-preview collector-search__preview" size="small">
                    <a href="" class="collector-preview__rating" title="Рейтинг пользователя">8/10</a>
                    <div class="collector-preview__item">
                        <div class="collector-preview__main">
                            <div class="collector-preview__thumbnail">
                                <a href=""><img class="collector-preview__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="collector-preview__info">
                                <div class="collector-preview__name"><a href="">Иванов Иван</a></div>
                                <div class="collector-preview__nickname"><a href="">@test-user</a></div>
                                <div class="collector-preview__subscribe">
                                    <x-ui.form.button color="cancel" size="small">Отписаться</x-ui.form.button>
                                    <x-ui.form.button class="collector-preview__button-message" tag="a" href="{{ route('collectors') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="collector-preview__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-ui.card>

                <x-ui.card class="collector-preview collector-search__preview" size="small">
                    <a class="collector-preview__rating collector-preview__rating_danger" title="Рейтинг пользователя" >4.5/10</a>
                    <div class="collector-preview__item">
                        <div class="collector-preview__main">
                            <div class="collector-preview__thumbnail">
                                <a href=""><img class="collector-preview__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                            </div>
                            <div class="collector-preview__info">
                                <div class="collector-preview__name"><a href="">Тестов Тест Тестович</a> </div>
                                <div class="collector-preview__nickname"><a href="">@testovichhhh</a></div>
                                <div class="collector-preview__subscribe">
                                    <x-ui.form.button size="small">Подписаться</x-ui.form.button>
                                    <x-ui.form.button class="collector-preview__button-message" tag="a" href="{{ route('collectors') }}" only-icon="true" size="small" title="Написать сообщение">
                                        <x-svg.message class="collector-preview__message-icon"></x-svg.message>
                                    </x-ui.form.button>
                                </div>
                            </div>
                        </div>

                        <x-common.counter-buttons
                            type="light"
                            class="collector-preview__buttons"
                            button-class="collector-preview__button"
                            badge-class="collector-preview__badge"
                            add="1200"
                            wishlist="5000"
                            sale="500000"
                            auction="2500"
                            exchange="20000"
                        />
                    </div>
                </x-ui.card>

                    <x-ui.card class="collector-preview collector-search__preview" size="small">
                        <a href="" class="collector-preview__rating" title="Рейтинг пользователя">9.5/10</a>
                        <div class="collector-preview__item">
                            <div class="collector-preview__main">
                                <div class="collector-preview__thumbnail">
                                    <a href=""><img class="collector-preview__img" src="{{ asset('/storage/test-300.jpg') }}" alt=""></a>
                                </div>
                                <div class="collector-preview__info">
                                    <div class="collector-preview__name"><a href="">Иванов Иван</a></div>
                                    <div class="collector-preview__nickname"><a href="">@test-user</a></div>
                                    <div class="collector-preview__subscribe">
                                        <x-ui.form.button color="cancel" size="small">Отписаться</x-ui.form.button>
                                        <x-ui.form.button class="collector-preview__button-message" tag="a" href="{{ route('collectors') }}" only-icon="true" size="small" title="Написать сообщение">
                                            <x-svg.message class="collector-preview__message-icon"></x-svg.message>
                                        </x-ui.form.button>
                                    </div>
                                </div>
                            </div>

                            <x-common.counter-buttons
                                type="light"
                                class="collector-preview__buttons"
                                button-class="collector-preview__button"
                                badge-class="collector-preview__badge"
                                add="1200"
                                wishlist="5"
                                sale="5"
                                auction="25"
                                exchange="2"
                            />
                        </div>
                    </x-ui.card>
            </div>
        </x-common.content>
    </x-grid.container>
</x-layouts.main>

<div class="footer">
    <div class="footer__inner">
        <x-grid.container>
            <div class="footer__main">


    {{--                    <div class="footer__numbers">--}}
    {{--                        <div class="footer__number">--}}
    {{--                            <div class="footer__number-title"><span class="footer__number-value">777325</span></div>--}}
    {{--                            <div class="footer__number-description">экземпляров</div>--}}
    {{--                        </div>--}}
    {{--                        <div class="footer__number">--}}
    {{--                            <div class="footer__number-title">на <span class="footer__number-value">7657</span></div>--}}
    {{--                            <div class="footer__number-description">полках</div>--}}
    {{--                        </div>--}}
    {{--                        <div class="footer__number">--}}
    {{--                            <div class="footer__number-title">у <span class="footer__number-value">7</span></div>--}}
    {{--                            <div class="footer__number-description">пользователей</div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

                <div class="footer__links">
                    <x-ui.card color="notransparent_dark">
                        <nav class="footer__menu">
                            <a href="#" class="footer__menu-link">О проекте</a>
                            <a href="#" class="footer__menu-link">Правила сайта</a>
                            <a href="#" class="footer__menu-link">Вопрос-ответ</a>
                            <a href="#" class="footer__menu-link">Справка/Помощь</a>
                            <a href="#" class="footer__menu-link">Контакты</a>
                            <a href="#" class="footer__menu-link">Техническая поддержка</a>
                        </nav>
                    </x-ui.card>
                </div>

                <div class="footer__media">
                    <x-common.logo
                        class="footer__logo"
                        class-site-icon="footer__site-icon"
                        class-site-name="footer__site-name" />

                    <div class="footer__social">
                        <svg width="24" height="24" viewBox="0 0 101 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_2_16)">
                                <path fill-rule="evenodd" fill="#fff" clip-rule="evenodd" d="M7.52944 7.02944C0.5 14.0589 0.5 25.3726 0.5 48V52C0.5 74.6274 0.5 85.9411 7.52944 92.9706C14.5589 100 25.8726 100 48.5 100H52.5C75.1274 100 86.4411 100 93.4706 92.9706C100.5 85.9411 100.5 74.6274 100.5 52V48C100.5 25.3726 100.5 14.0589 93.4706 7.02944C86.4411 0 75.1274 0 52.5 0H48.5C25.8726 0 14.5589 0 7.52944 7.02944ZM17.3752 30.4169C17.9168 56.4169 30.9167 72.0418 53.7084 72.0418H55.0003V57.1668C63.3753 58.0001 69.7082 64.1252 72.2498 72.0418H84.0835C80.8335 60.2085 72.2914 53.6668 66.9581 51.1668C72.2914 48.0835 79.7915 40.5835 81.5831 30.4169H70.8328C68.4995 38.6669 61.5836 46.1668 55.0003 46.8751V30.4169H44.2499V59.2501C37.5833 57.5835 29.1668 49.5002 28.7918 30.4169H17.3752Z" />
                            </g>
                            <defs>
                                <clipPath id="clip0_2_16">
                                    <rect width="100" height="100" fill="white" transform="translate(0.5)"/>
                                </clipPath>
                            </defs>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 48 48">
                            <path fill="currentColor" d="M41.42 7.309s3.885-1.515 3.56 2.164c-.107 1.515-1.078 6.818-1.834 12.553l-2.59 16.99s-.216 2.489-2.159 2.922c-1.942.432-4.856-1.515-5.396-1.948c-.432-.325-8.094-5.195-10.792-7.575c-.756-.65-1.62-1.948.108-3.463L33.649 18.13c1.295-1.3 2.59-4.33-2.806-.65l-15.11 10.28s-1.727 1.083-4.964.109l-7.016-2.165s-2.59-1.623 1.835-3.246c10.793-5.086 24.068-10.28 35.831-15.15"/>
                        </svg>

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path d="M2.661 14.337L6.801 0h6.362L11.88 4.444l-.038.077l-3.378 11.733h3.15q-1.982 4.934-3.086 7.733c-5.816-.063-7.442-4.228-6.02-9.155M8.554 24l7.67-11.035h-3.25l2.83-7.073c4.852.508 7.137 4.33 5.791 8.952C20.16 19.81 14.344 24 8.68 24h-.127z"/>
                        </svg>
                    </div>
                </div>

                        <div class="footer__donate">
{{--                                <div class="footer__donate-title">--}}
{{--                                    Поддержите проект. Для нас это важно--}}
{{--                                </div>--}}
                                <x-ui.form class="footer__donate-form">

                                    <div class="footer__donate-field">

                                            <x-ui.form.input-text
                                                placeholder="Введите любую сумму"
                                                id="name"
                                                name="name"
                                                required>
                                            </x-ui.form.input-text>
                                            <x-ui.form.button
                                                class="tooltip_trigger"
                                                type="button"
                                                color="info"
                                                tooltip="true"
                                                data-tooltip="tooltip_donate">
                                                ?
                                            </x-ui.form.button>

                                            <x-ui.tooltip
                                                class="tooltip_donate"
                                                id="tooltip_donate">
                                                {{ __('auth.username_tooltip') }}
                                            </x-ui.tooltip>
                                    </div>
                                    <div class="footer__donate-submit">
                                        <x-ui.form.button :full-width="true">
                                            <x-slot:icon class="button__icon-wrapper_submit">
                                                <x-svg.dollar class="button__submit-icon"></x-svg.dollar>
                                            </x-slot:icon>
                                            Поддержать проект
                                        </x-ui.form.button>
                                    </div>
                                </x-ui.form>

                        </div>




            </div>
            <x-grid type="container">
                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <div class="footer__politics">
                        <a href="#">Пользовательское соглашение</a>
                        <a href="#">Политика конфиденциальности</a>
                    </div>
                </x-grid.col>
                <x-grid.col xl="12" ls="12" ml="12" lg="6" md="6" sm="12">
                    <div class="footer__copyright">
                        @DustyShelf 2022-{{ now()->year }}. Все права защищены
                    </div>
                </x-grid.col>
            </x-grid>
        </x-grid.container>
    </div>

    <div class="footer__waves-wrapper">
    <svg class="footer__waves" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
        <defs>
            <path id="footer-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
        </defs>
        <g class="footer__parallax">
            <use class="footer__wave-1" xlink:href="#footer-wave" x="48" y="1" />
            <use class="footer__wave-3" xlink:href="#footer-wave" x="48" y="4" />
            <use class="footer__wave-4" xlink:href="#footer-wave" x="48" y="9" />
        </g>
    </svg>
    </div>
</div>

<div class="mobile-main-menu">
    <nav class="mobile-main-menu__inner">
        <a href="{{ route('feed') }}" class="mobile-main-menu__link">
            <x-svg.home class="mobile-main-menu__item-icon"></x-svg.home>
        </a>

        <a href="{{ route('feed') }}" class="mobile-main-menu__link">
            <x-svg.shelves class="mobile-main-menu__item-icon"></x-svg.shelves>
        </a>

        <a href="{{ route('feed') }}" class="mobile-main-menu__link">
            <x-svg.plus class="mobile-main-menu__item-icon"></x-svg.plus>
        </a>

        <a href="{{ route('feed') }}" class="mobile-main-menu__link">
            <x-svg.burger class="mobile-main-menu__item-icon"></x-svg.burger>
        </a>
            <x-common.chat-icon-notification class="mobile-main-menu__link mobile-main-menu__chat" count="5" />
    </nav>
</div>

<div class="footer">
    <div class="footer__inner">
        <x-grid.container>
            <div class="footer__main">
                <div class="footer__links">
                    <div class="footer__links-wrapper">
                        <nav class="footer__menu">
                            @foreach($menu as $item)
                                <a href="{{ $item->link() }}" class="footer__menu-link {{ $item->class() }}">{{ $item->label() }}</a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <div class="footer__media">
                    <x-common.logo
                        class="footer__logo"
                        class-site-icon="footer__site-icon"
                        class-site-name="footer__site-name" />

                    <div class="footer__social">
                        <x-svg.social.vk class="footer__social-icon"></x-svg.social.vk>
                        <x-svg.social.telegram class="footer__social-icon"></x-svg.social.telegram>
                        <x-svg.social.boosty class="footer__social-icon"></x-svg.social.boosty>
                    </div>
                </div>

                <div class="footer__donate">
                    <x-ui.form class="footer__donate-form">
                        <div class="footer__donate-field">
                                <x-ui.form.input-text
                                    placeholder="{{ __('common.enter_support_value') }}"
                                    id="name"
                                    name="name"
                                    required>
                                </x-ui.form.input-text>

                                <x-ui.form.button
                                    type="button"
                                    color="dark"
                                    tooltip="true"
                                    data-tippy-content="{{ __('common.support_description') }}"
                                    data-tooltip="tooltip_donate">
                                    ?
                                </x-ui.form.button>
                        </div>
                        <div class="footer__donate-submit">
                            <x-ui.form.button :full-width="true">
                                <x-slot:icon>
                                    <x-svg.coin></x-svg.coin>
                                </x-slot:icon>
                                {{ __('common.support_project') }}
                            </x-ui.form.button>
                        </div>
                    </x-ui.form>
                </div>
            </div>

            <x-grid.col xl="12">
                <div class="footer__politics">
                    <a href="#">{{ __('common.politics') }}</a>
                    <a href="#">{{ __('common.agreement') }}</a>
                </div>
            </x-grid.col>

            <x-grid.col xl="12">
                <div class="footer__copyright">
                    @DustyShelf 2022-{{ now()->year }}. {{ __('common.rights') }}
                </div>
            </x-grid.col>
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

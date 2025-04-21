<div class="footer">
    <div class="footer__inner">
        <x-grid.container>
            Footer
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

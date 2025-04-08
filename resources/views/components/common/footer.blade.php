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

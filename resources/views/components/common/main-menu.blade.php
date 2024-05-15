<nav
    {{ $attributes->class([
            'main-menu'
        ])
    }}>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="#">
            {{ __('common.shelf') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="#">
            {{ __('common.blog') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="{{ route('feed') }}">
            {{ __('common.feed') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="{{ route('users') }}">
            {{ __('common.more') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            class="main-menu__link"
            href="{{ route('search') }}">
            {{ __('common.add') }}
        </x-ui.form.button>
    </div>
</nav>

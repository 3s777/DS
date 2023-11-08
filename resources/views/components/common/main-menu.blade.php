<nav class="main-menu">
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="#">
            {{ __('Shelfs') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="#">
            {{ __('Blog') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="#">
            {{ __('Feed') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            color="dark"
            class="main-menu__link"
            href="{{ route('users') }}">
            {{ __('Users') }}
        </x-ui.form.button>
    </div>
    <div class="main-menu__item">
        <x-ui.form.button
            tag="a"
            class="main-menu__link"
            href="{{ route('search') }}">
            {{ __('Add') }}
        </x-ui.form.button>
    </div>
</nav>

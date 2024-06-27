<nav
    {{ $attributes->class([
            'main-menu'
        ])
    }}>
    @foreach($menu->all() as $item)
        <div class="main-menu__item">
            <x-ui.form.button
                tag="a"
                color="dark"
                @class(['main-menu__link', $item->class(), 'button_submit' => $item->isActive()])
                href="{{ $item->link() }}">
                {{ $item->label() }}
            </x-ui.form.button>
        </div>
    @endforeach
</nav>

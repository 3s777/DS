<nav x-data="{ moreOpen: false }"
    {{ $attributes->class([
            'main-menu'
        ])
    }}>
    @foreach($menu->all() as $item)
        @if($item->class() == 'main-menu__button-more')
            <div class="main-menu__item">
                <x-ui.form.button
                    x-on:click="moreOpen =! moreOpen"
                    tag="div"
                    color="dark"
                    @class(['main-menu__link', $item->class()])>
                    {{ $item->label() }}
                </x-ui.form.button>
            </div>
        @else
            <div class="main-menu__item">
                <x-ui.form.button
                    tag="a"
                    color="dark"
                    @class(['main-menu__link', $item->class(), 'button_submit' => $item->isActive()])
                    href="{{ $item->link() }}">
                    {{ $item->label() }}
                </x-ui.form.button>
            </div>
        @endif
    @endforeach

    <x-ui.card x-show="moreOpen" x-on:click.outside="moreOpen = false" class="main-menu__more" size="small" color="notransparent_dark">
        <div x-on:click="moreOpen = false"  class="main-menu__more-close">
            <x-svg.close class="main-menu__close-icon"></x-svg.close>
        </div>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
    </x-ui.card>
</nav>

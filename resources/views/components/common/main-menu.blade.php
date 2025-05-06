<nav x-data="{ moreOpen: false, addOpen:false }"
    {{ $attributes->class([
            'main-menu'
        ])
    }}>
    @foreach($menu->all() as $item)
        @if($item->id() === 'more')
            <div class="main-menu__item">
                <x-ui.form.button
                    x-on:click="moreOpen =! moreOpen"
                    tag="div"
                    color="dark"
                    @class(['main-menu__link', $item->class()])>
                    {{ $item->label() }}
                </x-ui.form.button>
            </div>

            @continue
        @endif

        @if($item->id() === 'add')
            <div class="main-menu__item">
                <x-ui.form.button
                    x-on:click="addOpen =! addOpen"
                    tag="div"
                    color="dark"
                    @class(['main-menu__link', $item->class()])>
                    {{ $item->label() }}
                </x-ui.form.button>
            </div>

            @continue
        @endif

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

    <div x-cloak x-show="moreOpen" x-on:click.outside="moreOpen = false" class="main-menu__more">
        <div x-on:click="moreOpen = false"  class="main-menu__more-close">
            <x-svg.close class="main-menu__close-icon"></x-svg.close>
        </div>
        <div class="main-menu__sub">
            @foreach($subMenu as $link)
                <div class="main-menu__sub-item">
                    <a href="{{ $link->link() }}" class="main-menu__sub-link">
                        <x-dynamic-component component="svg.{{ $link->icon() }}" class="main-menu__sub-link-icon" />
                        <div class="main-menu__sub-link-label">
                            <div class="main-menu__sub-link-title">{{ $link->label() }}</div>
                            <div class="main-menu__sub-link-description">{{ $link->description() }}</div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div x-cloak x-show="addOpen" x-on:click.outside="addOpen = false" class="main-menu__more">
        <div x-on:click="addOpen = false"  class="main-menu__more-close">
            <x-svg.close class="main-menu__close-icon"></x-svg.close>
        </div>
        <div class="main-menu__sub main-menu__sub_add">
            @foreach($addMenu as $link)
                <div class="main-menu__sub-item main-menu__sub-item_add">
                    <a href="{{ $link->link() }}" class="main-menu__sub-link">
{{--                        <x-dynamic-component component="svg.{{ $link->icon() }}" class="main-menu__sub-link-icon" />--}}
                        <div class="main-menu__sub-link-label">
                            <div class="main-menu__sub-link-title">{{ $link->label() }}</div>
{{--                            <div class="main-menu__sub-link-description">{{ $link->description() }}</div>--}}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</nav>

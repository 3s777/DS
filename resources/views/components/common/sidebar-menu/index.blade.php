@props([
    'hideButton' => true
])

<nav
    :class="collapseSidebar ?  'sidebar-menu_collapsed' : ''"
    {{ $attributes->class([
            'sidebar-menu'
        ])
    }}>

    @if($hideButton)

    @endif
    <x-ui.form.button
        x-on:click="collapseSidebar = ! collapseSidebar"
        class="content__sidebar-link sidebar-menu__link sidebar-menu__link_collapse"
        tag="a"
        color="light"
        title="Развернуть меню">
        <x-slot:icon class="sidebar-menu__link-icon sidebar-menu__link-icon_collapse">
            <x-svg.collapse-left />
        </x-slot:icon>
        <span class="sidebar-menu__link-label">Свернуть меню</span>
    </x-ui.form.button>

    <div class="sidebar-menu__content">
        @foreach($menu->all() as $item)
            @if($item->type() === 'link')
                <x-common.sidebar-menu.link :link="$item" />
            @endif
            @if($item->type() === 'group')
                <x-common.sidebar-menu.group :group="$item" :parent="true" />
            @endif
        @endforeach
    </div>
</nav>


@props([
    'hideButton' => false
])

<nav
    :class="collapseSidebar ?  'sidebar-menu_collapsed' : ''"
    {{ $attributes->class([
            'sidebar-menu'
        ])
    }}>

    @if(!$hideButton)
        <x-common.sidebar-menu.hide-button />
    @endif

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

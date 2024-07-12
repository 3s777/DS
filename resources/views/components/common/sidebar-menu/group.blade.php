@props([
    'group',
    'parent' => false
])

@if($parent)
    <x-ui.form.button
        @class(['sidebar-menu__link', 'sidebar-menu__link-icon_toggle', 'button_submit' => $group->isActive()])
        tag="a"
        color="light">
        @if($group->icon())
            <x-slot:icon class="sidebar-menu__link-icon">
                <x-dynamic-component component="svg.{{ $group->icon() }}" class="mt-4" />
            </x-slot:icon>
        @endif
    </x-ui.form.button>
@endif

<x-ui.accordion class="sidebar-menu__accordion">
    <x-ui.accordion.item
        {{ $attributes->class([
            'sidebar-menu__accordion-item',
           ])
        }}
        :open="$group->isActive()"
        color="light">

        <x-ui.accordion.title
            @class(['sidebar-menu__accordion-title', 'sidebar-menu__accordion-title_opened' => $group->isActive()])>
            <span class="sidebar-menu__link-label">{{ $group->label() }}</span>
        </x-ui.accordion.title>

        <x-ui.accordion.content>
            @foreach($group->all() as $item)
                @if($item->type() === 'link')
                    <x-common.sidebar-menu.link :link="$item" />
                @endif
                @if($item->type() === 'group')
                    <x-common.sidebar-menu.group :group="$item" />
                @endif
            @endforeach
        </x-ui.accordion.content>
    </x-ui.accordion.item>
</x-ui.accordion>

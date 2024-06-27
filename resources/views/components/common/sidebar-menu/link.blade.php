@props([
    'link'
])

<x-ui.form.button
    {{ $attributes->class([
        'sidebar-menu__link',
        'button_submit' => $link->isActive()
       ])
    }}
    tag="a"
    href="{{ $link->link() }}"
    color="light">
    @if($link->icon())
        <x-slot:icon class="sidebar-menu__link-icon">
            <x-dynamic-component component="svg.{{ $link->icon() }}" />
        </x-slot:icon>
    @endif
    <span class="sidebar-menu__link-label">{{ $link->label() }}</span>
</x-ui.form.button>

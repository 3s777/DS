@props([
    'label' => __('common.collapse_menu')
])

<x-ui.form.button
    {{ $attributes->class([
            'content__sidebar-link',
            'sidebar-menu__link',
            'sidebar-menu__link_collapse'
        ])
    }}
    x-on:click="collapseSidebar = ! collapseSidebar"
    tag="a"
    color="light"
    title="{{ __('common.expand_menu') }}">
    <x-slot:icon class="sidebar-menu__link-icon sidebar-menu__link-icon_collapse">
        <x-svg.collapse-left />
    </x-slot:icon>
    <span class="sidebar-menu__link-label">{{ $label }}</span>
</x-ui.form.button>


@push('scripts')
    <script>
        const list = document.querySelectorAll('.sidebar-menu__link-icon_toggle')

        const sidebar = document.querySelector('.content__sidebar')

        const menu = document.querySelector('.sidebar-menu')

        list.forEach(item =>{
            item.addEventListener('click', (e) =>{
                sidebar.classList.remove('content__sidebar_collapsed');
                menu.classList.remove('sidebar-menu_collapsed');
                // list.forEach(el=>{ el.classList.remove('active'); });
                // item.classList.add('active')
            })
        })
    </script>
@endpush

<nav
    :class="collapseSidebar ?  'sidebar-menu_collapsed' : ''"
    {{ $attributes->class([
            'sidebar-menu'
        ])
    }}>
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
        <x-ui.form.button
            class="content__sidebar-link sidebar-menu__link"
            tag="a"
            color="light">
            <x-slot:icon class="sidebar-menu__link-icon">
                <x-svg.statistic />
            </x-slot:icon>
            <span class="sidebar-menu__link-label">Статистика</span>
        </x-ui.form.button>

        <x-ui.form.button
            class="content__sidebar-link sidebar-menu__link"
            tag="a"
            color="light">
            <x-slot:icon class="sidebar-menu__link-icon">
                <svg fill="#fff" width="20px" height="20px" viewBox="0 0 45.532 45.532" xml:space="preserve">
                    <g>
                        <path d="M22.766,0.001C10.194,0.001,0,10.193,0,22.766s10.193,22.765,22.766,22.765c12.574,0,22.766-10.192,22.766-22.765
                            S35.34,0.001,22.766,0.001z M22.766,6.808c4.16,0,7.531,3.372,7.531,7.53c0,4.159-3.371,7.53-7.531,7.53
                            c-4.158,0-7.529-3.371-7.529-7.53C15.237,10.18,18.608,6.808,22.766,6.808z M22.761,39.579c-4.149,0-7.949-1.511-10.88-4.012
                            c-0.714-0.609-1.126-1.502-1.126-2.439c0-4.217,3.413-7.592,7.631-7.592h8.762c4.219,0,7.619,3.375,7.619,7.592
                            c0,0.938-0.41,1.829-1.125,2.438C30.712,38.068,26.911,39.579,22.761,39.579z"/>
                    </g>
                </svg>
{{--                <svg fill="#fff" width="20px" height="20px" viewBox="0 0 32 32">--}}
{{--                        <path d="M16,16A7,7,0,1,0,9,9,7,7,0,0,0,16,16ZM16,4a5,5,0,1,1-5,5A5,5,0,0,1,16,4Z"/>--}}
{{--                        <path d="M17,18H15A11,11,0,0,0,4,29a1,1,0,0,0,1,1H27a1,1,0,0,0,1-1A11,11,0,0,0,17,18ZM6.06,28A9,9,0,0,1,15,20h2a9,9,0,0,1,8.94,8Z"/>--}}
{{--                </svg>--}}
            </x-slot:icon>
            <span class="sidebar-menu__link-label">Профиль</span>
        </x-ui.form.button>

        <div class="sidebar-menu__accordion-wrapper">
            <x-ui.form.button
                class="sidebar-menu__link sidebar-menu__link-icon_toggle"
                tag="a"
                color="light">
                <x-slot:icon class="sidebar-menu__link-icon">
                    <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         viewBox="0 0 512 512"  xml:space="preserve">
<style type="text/css">
    .st0{fill:#fff;}
</style>
                        <g>
                            <path class="st0" d="M389.486,226.898H122.515C54.852,226.898,0,281.746,0,349.413c0,67.659,54.852,122.514,122.515,122.514
		c42.645,0,80.192-21.812,102.128-54.855h62.711c21.94,33.043,59.491,54.855,102.132,54.855
		c67.667,0,122.514-54.855,122.514-122.514C512,281.746,457.153,226.898,389.486,226.898z M176.155,364.052h-37.794v37.778h-32.916
		v-37.778H67.659v-32.928h37.786v-37.786h32.916v37.786h37.794V364.052z M358.495,363.774c-7.929,7.929-20.783,7.929-28.716,0
		c-7.936-7.929-7.936-20.794,0-28.723c7.933-7.929,20.787-7.929,28.716-0.008C366.424,342.98,366.424,355.846,358.495,363.774z
		 M403.84,409.127c-7.921,7.921-20.779,7.921-28.715-0.008c-7.937-7.929-7.937-20.786,0-28.715
		c7.936-7.929,20.794-7.945,28.715-0.016C411.777,388.333,411.777,401.19,403.84,409.127z M403.84,318.422
		c-7.921,7.929-20.779,7.929-28.715,0c-7.922-7.929-7.937-20.794,0-28.723c7.936-7.929,20.794-7.929,28.715,0
		C411.777,297.627,411.777,310.493,403.84,318.422z M449.193,363.774c-7.921,7.929-20.786,7.929-28.724,0
		c-7.937-7.929-7.937-20.794,0-28.723c7.937-7.929,20.802-7.929,28.724,0C457.122,342.98,457.122,355.846,449.193,363.774z"/>
                            <path class="st0" d="M268.928,110.894c0-2.46,0.49-4.72,1.361-6.802c1.319-3.116,3.548-5.8,6.337-7.69
		c2.8-1.89,6.09-2.97,9.753-2.97c2.441,0,4.709,0.494,6.792,1.373c3.112,1.311,5.804,3.533,7.69,6.333
		c1.882,2.8,2.97,6.086,2.97,9.756c0,5.893,1.207,11.593,3.39,16.753c3.282,7.744,8.724,14.293,15.588,18.928
		c6.849,4.644,15.206,7.374,24.076,7.366c5.912,0,11.612-1.211,16.764-3.394c7.728-3.278,14.285-8.716,18.92-15.58
		c4.644-6.857,7.367-15.21,7.367-24.073V40.073h-25.608v70.821c0,2.438-0.478,4.705-1.358,6.78c-1.319,3.124-3.556,5.808-6.333,7.69
		c-2.807,1.881-6.093,2.969-9.753,2.969c-2.437,0-4.705-0.486-6.784-1.365c-3.12-1.311-5.804-3.548-7.69-6.333
		c-1.886-2.8-2.97-6.1-2.986-9.742c0.016-5.924-1.192-11.616-3.378-16.768c-3.282-7.744-8.72-14.292-15.585-18.928
		c-6.864-4.651-15.209-7.374-24.084-7.366c-5.908-0.008-11.604,1.203-16.764,3.394c-7.74,3.263-14.292,8.716-18.932,15.58
		c-4.639,6.857-7.358,15.21-7.358,24.088v104.712h25.603V110.894z"/>
                        </g>
</svg>
                </x-slot:icon>
            </x-ui.form.button>

            <x-ui.accordion class="sidebar-menu__accordion">
                <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light" open>
                    <x-ui.accordion.title class="sidebar-menu__accordion-title">
                        <span class="sidebar-menu__link-label">Игры</span>
                    </x-ui.accordion.title>
                    <x-ui.accordion.content>
                        <x-ui.accordion>
                            <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light" open>
                                <x-ui.accordion.title class="sidebar-menu__accordion-title">
                                    <span class="sidebar-menu__link-label">Разработчики</span>
                                </x-ui.accordion.title>
                                <x-ui.accordion.content>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.create'])
                                        tag="a"
                                        link="{{ route('game-developers.create') }}"
                                        color="light"
                                    >
                                        <span class="sidebar-menu__link-label">Добавить</span>
                                    </x-ui.form.button>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.index'])
                                        tag="a"
                                        link="{{ route('game-developers.index') }}"
                                        color="light">
                                        <span class="sidebar-menu__link-label">Список</span>
                                    </x-ui.form.button>
                                </x-ui.accordion.content>
                            </x-ui.accordion.item>

                            <x-ui.accordion.item class="sidebar-menu__accordion-item" color="light">
                                <x-ui.accordion.title class="sidebar-menu__accordion-title">
                                    <span class="sidebar-menu__link-label">Издатели</span>
                                </x-ui.accordion.title>
                                <x-ui.accordion.content>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.create'])
                                        tag="a"
                                        link="{{ route('game-developers.create') }}"
                                        color="light"
                                    >
                                        <span class="sidebar-menu__link-label">Добавить</span>
                                    </x-ui.form.button>
                                    <x-ui.form.button
                                        @class(['content__sidebar-link', 'sidebar-menu__link', 'button_submit' => Route::currentRouteName() === 'game-developers.index'])
                                        tag="a"
                                        link="{{ route('game-developers.index') }}"
                                        color="light">
                                        <span class="sidebar-menu__link-label">Список</span>
                                    </x-ui.form.button>
                                </x-ui.accordion.content>
                            </x-ui.accordion.item>

                        </x-ui.accordion>

                    </x-ui.accordion.content>
                </x-ui.accordion.item>
            </x-ui.accordion>
        </div>

    </div>
</nav>

<script>
    const list = document.querySelectorAll('.sidebar-menu__link-icon_toggle')

    const sidebar = document.querySelector('.content__sidebar')

    const menu = document.querySelector('.sidebar-menu')

    list.forEach(item =>{
        item.addEventListener('click', (e) =>{
            console.log('Привет');
            sidebar.classList.remove('content__sidebar_collapsed');
            menu.classList.remove('sidebar-menu_collapsed');
            // list.forEach(el=>{ el.classList.remove('active'); });
            // item.classList.add('active')
        })
    })
</script>

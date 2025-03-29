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

    <x-ui.card x-cloak x-show="moreOpen" x-on:click.outside="moreOpen = false" class="main-menu__more" size="small" color="notransparent_dark">
        <div x-on:click="moreOpen = false"  class="main-menu__more-close">
            <x-svg.close class="main-menu__close-icon"></x-svg.close>
        </div>
            @guest('admin')
                @if(Route::currentRouteName() != 'admin.login')
                <x-ui.form.group>
                    <div class="auth-menu__item">
                        <x-ui.form.button
                            tag="a"
                            class="auth-menu__link"
                            href="{{ route('admin.login') }}">
                            {{ __('auth.login') }} админ
                        </x-ui.form.button>
                    </div>
                </x-ui.form.group>
                @endif
                @if (Route::has('admin.register') && Route::currentRouteName() != 'admin.register')
                    <x-ui.form.group>
                        <div class="auth-menu__item">
                            <x-ui.form.button
                                tag="a"
                                class="auth-menu__link"
                                href="{{ route('admin.register') }}">
                                {{ __('auth.register') }} админ
                            </x-ui.form.button>
                        </div>
                    </x-ui.form.group>
                @endif
            @else
                <div class="profile-menu__auth">
                    <div class="profile-menu__links">
                        <a class="profile-menu__username " href="#">
                            {{ Auth::guard('admin')->user()->name }}
                        </a>

                        <div class="profile-menu__logout">
                            <a class="profile-menu__logout-link"
                               href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit(); ">
                                {{ __('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            @endguest

        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
        Тут будет дополнительное меню<br>
    </x-ui.card>
</nav>

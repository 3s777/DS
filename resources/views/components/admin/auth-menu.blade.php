<nav
    {{ $attributes->class([
            'auth-menu'
        ])
    }}>
        @guest('admin')
            @if(Route::currentRouteName() != 'admin.login')
                <div class="auth-menu__item">
                    <x-ui.form.button
                        tag="a"
                        color="dark"
                        class="auth-menu__link"
                        href="{{ route('admin.login') }}">
                        {{ __('auth.login') }}
                    </x-ui.form.button>
                </div>
            @endif
            @if (Route::has('admin.register') && Route::currentRouteName() != 'admin.register')
                <div class="auth-menu__item">
                    <x-ui.form.button
                        tag="a"
                        color="dark"
                        class="auth-menu__link"
                        href="{{ route('admin.register') }}">
                        {{ __('auth.register') }}
                    </x-ui.form.button>
                </div>
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
                       document.getElementById('logout-form-admin').submit(); ">
                            {{ __('auth.logout') }}
                        </a>

                        <form id="logout-form-admin" action="{{ route('admin.logout') }}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endguest
</nav>

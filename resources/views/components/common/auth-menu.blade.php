<nav
    {{ $attributes->class([
            'auth-menu'
        ])
    }}>
        @guest('collector')
            @if(Route::currentRouteName() != 'collector.login')
                <div class="auth-menu__item">
                    <x-ui.form.button
                        tag="a"
                        color="dark"
                        class="auth-menu__link"
                        href="{{ route('collector.login') }}">
                        {{ __('auth.login') }}
                    </x-ui.form.button>
                </div>
            @endif
            @if (Route::has('admin.register') && Route::currentRouteName() != 'collector.register')
                <div class="auth-menu__item">
                    <x-ui.form.button
                        tag="a"
                        color="dark"
                        class="auth-menu__link"
                        href="{{ route('collector.register') }}">
                        {{ __('auth.register') }}
                    </x-ui.form.button>
                </div>
            @endif
        @else
            <div class="profile-menu__auth">
                {{--            <x-ui.avatar--}}
                {{--                class="profile-menu__avatar"--}}
                {{--                link="{{ route('ui') }}"--}}
                {{--                src="{{ asset('/storage/test-5.jpg') }}"--}}
                {{--                username="{{ Auth::user()->name }}"--}}
                {{--            >--}}
                {{--            </x-ui.avatar>--}}

                <div class="profile-menu__links">
                    <a class="profile-menu__username " href="{{ route('profile') }}">
                        {{ Auth::guard('collector')->user()->name }}
                    </a>

                    <div class="profile-menu__logout">
                        <a class="profile-menu__logout-link"
                           href="{{ route('collector.logout') }}"
                           onclick="event.preventDefault();
                       document.getElementById('logout-form-collector').submit(); ">
                            {{ __('auth.logout') }}
                        </a>

                        <form id="logout-form-collector" action="{{ route('collector.logout') }}" method="POST">
                            @method('DELETE')
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @endguest
</nav>

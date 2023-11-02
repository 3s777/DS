<nav class="auth-menu">
    @guest
        @if(Route::currentRouteName() != 'login')
            <div class="auth-menu__item">
                <a class="button button_dark auth-menu__link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
        @endif
        @if (Route::has('register') && Route::currentRouteName() != 'register')
            <div class="auth-menu__item">
                <a class="button button_dark auth-menu__link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </div>
        @endif
    @else
        <div class="profile-menu__auth">
            <x-ui.avatar
                class="profile-menu__avatar"
                link="{{ route('ui') }}"
                src="{{ asset('/storage/test-5.jpg') }}"
                username="{{ Auth::user()->name }}"
            >
            </x-ui.avatar>

            <div class="profile-menu__links">
                <a class="profile-menu__username " href="#">
                    {{--{{ Auth::user()->name }}--}} Александр Синица
                </a>

                <div class="profile-menu__logout">
                    <a class="profile-menu__logout-link"
                       href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();
                                        ">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    @endguest
</nav>

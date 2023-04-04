<div class="container">
    <div class="grid">
        <div class="col-desk-3 col-tab-6">dfssfd</div>
        <div class="col-desk-3 col-tab-6">dfssfd</div>
        <div class="col-desk-3 col-tab-6">dfssfd</div>
        <div class="col-desk-3 col-tab-6" style="text-align: right">dfssfddfssfddfssfddfssfddfssfd dfssfd dfssfd dfssfddfssfd dfssfddfssfd</div>
    </div>
</div>


<header class="header">
    <div class="container">
        <div class="header__inner">
            <div class="logo">
                <a class="logo__link" href="{{ url('/') }}">
                    @include('inline-svg/logo-img')
                    @include('inline-svg/logo-text')
                </a>
            </div>

            <nav class="main-menu">
                <a class="button main-menu__item" href="#">Shelfs</a>
                <a class="button main-menu__item" href="#">Blog</a>
                <a class="button main-menu__item" href="#">Feed</a>
                <a class="button main-menu__item" href="#">Users</a>
                <a class="button main-menu__item" href="#">Add</a>
            </nav>

            <div class="user-profile">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>

    </div>
</header>

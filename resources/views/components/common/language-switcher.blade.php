<nav {{ $attributes->class([
            'language-switcher',
        ])
    }}>

    @foreach($switchers as $locale => $switcher)
        <a href="{{ $switcher }}">
            <div class="site-settings__flag @if(app()->getLocale() == $locale) site-settings__flag_active @endif">
                <x-dynamic-component :component="'svg.flags.'.$locale" />
            </div>
        </a>
    @endforeach
</nav>

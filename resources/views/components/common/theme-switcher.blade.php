<nav {{ $attributes->class([
            'theme-switcher',
        ])
    }}>

    @foreach($switchers as $locale => $switcher)
        <a class="theme-switcher__color theme-switcher__color_{{ $switcher }}
            @if($linkClass)
                {{ $linkClass }}__color {{ $linkClass }}__color_{{ $switcher }}
            @endif"
           href="{{ route('set.theme', $switcher) }}">
        </a>
    @endforeach
</nav>

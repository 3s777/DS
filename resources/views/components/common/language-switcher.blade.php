<div>
    @foreach($localeRoutes as $route)
        <a href="{{ $route['url'] }}">
            <div class="site-settings__flag @if(app()->getLocale() == $route['name']) site-settings__flag_active @endif">
                <x-dynamic-component :component="$route['icon']" />
            </div>
        </a>
    @endforeach
</div>

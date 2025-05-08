@if(request('filters'))
    <div {{ $attributes->class([
            'current-filters',
        ])
    }}>
        @foreach(filters() as $filter)
            @if($loop->first)
                <div class="current-filters__title">{{ __('filters.badges_title') }}: </div>
            @endif

            @if($filter->preparedValues())
                {!! $filter->badgeView() !!}
            @endif

            @if($loop->last)
                <x-ui.badge
                    class="current-filters__badge"
                    type="tag"
                    color="danger">
                    <a href="{{ request()->url() }}">
                        {{ __('filters.reset_all') }}
                    </a>
                </x-ui.badge>
            @endif
        @endforeach
    </div>
@endif

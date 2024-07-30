<x-ui.badge
        class="current-filters__badge"
        type="tag"
        color="dark">

    {{ $filter->title() }}:

    @if(is_array($filter->preparedValues()))
        @foreach($filter->preparedValues() as $key => $value)
             {{ $value }}
            <div class="current-filters__delete">
                <a href="{{ request()->fullUrlWithoutQuery(['filters.'.$filter->key().'.'.$key]) }}">
                    <x-svg.close></x-svg.close>
                </a>
            </div>
        @endforeach
    @else
        {{ $filter->preparedValues() }}
        <div class="current-filters__delete">
            <a href="{{ request()->fullUrlWithoutQuery(['filters.'.$filter->key()]) }}">
                <x-svg.close></x-svg.close>
            </a>
        </div>
    @endif
</x-ui.badge>

@props([
    'name',
])

<a href="{{ filter_url(['sort' => $name, 'order' => request('order') == 'asc' ? 'desc' : 'asc']) }}">
    <div class="responsive-table__arrow
                @if(request('sort') == $name) responsive-table__arrow_active @endif
                @if(request('order') == 'desc' && request('sort') == $name) responsive-table__arrow_desc @endif">
    </div>
</a>

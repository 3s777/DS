
<div>{{ $filter->title() }}</div>
<div>@dump($filter->requestValue())</div>
<input
    id="{{ $filter->id() }}"
    name="{{ $filter->name() }}"
    type="text">

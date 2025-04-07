@props([
    'get' => false,
    'method' => 'POST',
    'preventSubmit' => true,
    'action' => false,
    'id' => false
])

<form
    {{ $attributes->class([
            'form'
        ])->merge([
            'action' => $action,
            'method' => $get ? 'GET' :'POST',
            'id' => $id
        ])
    }}
    @if($preventSubmit)
        x-data="{ preventSubmit: false }" x-on:submit="preventSubmit = true"
        @endif
    >
    @if(!$get)
        @csrf
        @method($method)
    @endif

    {{ $slot }}
</form>

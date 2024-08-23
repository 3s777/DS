@props([
    'method' => 'POST',
    'preventSubmit' => true,
    'action' => false
])

<form
    {{ $attributes->class([
            'form'
        ])->merge([
            'action' => $action,
            'method' => 'POST'
        ])
    }}
    @if($preventSubmit)
        x-data="{ preventSubmit: false }" x-on:submit="preventSubmit = true"
        @endif
    >
    @csrf
    @method($method)

    {{ $slot }}
</form>

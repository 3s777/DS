@props([
    'method' => 'POST',
    'preventSubmit' => true
])

<form
    {{ $attributes->class([
            'form'
        ])->merge([
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

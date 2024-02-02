@props([
    'method' => 'POST'
])

<form
    {{ $attributes->class([
            'form'
        ])->merge([
            'method' => 'POST'
        ])
    }}>
    @csrf
    @method($method)

    {{ $slot }}
</form>

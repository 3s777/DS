<select
    {{ $attributes->class([
            'select',
        ])
        ->merge([
            'id' => $id,
            'name' => $name,
        ])
    }}>
    {{ $slot }}
</select>

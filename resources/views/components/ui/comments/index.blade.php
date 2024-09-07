@props([
    'status' => 'open',
    'title' => 'Comments',
    'title_count' => 'Total comments:',
    'count' => false
])

<div
    {{ $attributes->class([
            'comments',
        ])
    }}>

    <x-ui.title
        indent="normal">
        {{ __($title) }}
    </x-ui.title>

    <x-ui.comments.form
        id="new-comment">
    </x-ui.comments.form>

    <x-ui.title
        indent="normal">
        {{ __($title_count) }} {{ $count }}
    </x-ui.title>

    {{ $slot }}
</div>

@props([
    'title'
])

<div class="content__title">
    <x-ui.title tag="h1" size="big" >
        {{ $title }}
    </x-ui.title>

    {{ $slot }}
</div>

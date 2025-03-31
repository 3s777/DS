@props([
    'sidebar' => false,
    'wrapperClass' => false
])

<div
    {{ $attributes->class([
            'content',
            'content_sidebar' => $sidebar
        ])
    }}
    :class="collapseSidebar ?  'content_collapsed' : ''"
>
    @if($sidebar)
        <aside
            class="content__sidebar"
            :class="collapseSidebar ?  'content__sidebar_collapsed' : ''"
            {{ $sidebar->attributes->class([
                'content__sidebar'
            ])
        }}>
            {{ $sidebar }}
        </aside>
        <section class="content__wrapper {{ $wrapperClass }}">
            {{ $slot }}
        </section>
    @else
        {{ $slot }}
    @endif
</div>

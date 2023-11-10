@props([
    'sidebar' => false,
    'wrapperClass' => false
])

<div
    {{ $attributes->class([
            'content',
            'content_sidebar' => $sidebar
        ])
    }}>
    @if($sidebar)
        <aside {{ $sidebar->attributes->class([
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

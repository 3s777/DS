@props([
    'footer' => false,
    'empty' => false,
])

<div class="responsive-table">
    <div class="responsive-table__scroll-buttons">
        <x-ui.form.button class="responsive-table__scroll-button responsive-table__scroll-button_left" onclick="leftScroll()"></x-ui.form.button>
        <x-ui.form.button class="responsive-table__scroll-button responsive-table__scroll-button_right" onclick="rightScroll()"></x-ui.form.button>
    </div>

    <div class="responsive-table__inner">
        <div
            {{ $attributes->class([
                    'responsive-table__content'
                ])
            }}>

            {{ $slot }}
        </div>

        @if($empty)
            <x-common.missing>
                {{ __('common.not_found') }}
            </x-common.missing>
        @endif

        @if($footer)
            <div
                {{ $footer->attributes->class([
                        'responsive-table__footer'
                    ])
                }}>
                {{ $footer }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
    <script>
        function leftScroll() {
            const leftButton = document.querySelector(".responsive-table__inner");
            leftButton.scrollBy({
                top: 0,
                left: -250,
                behavior: 'smooth'
            });
        }
        function rightScroll() {
            const rightButton = document.querySelector(".responsive-table__inner");
            rightButton.scrollBy({
                top: 0,
                left: 250,
                behavior: 'smooth'
            });
        }

        function handleScroll() {
            let parent = document.querySelector('.responsive-table');
            let child = parent.querySelector('.responsive-table__scroll-buttons');
            let parentPosition = parent.getBoundingClientRect();
            let rightSpace =  window.innerWidth - 18 - (parentPosition.x + parentPosition.width);

            let parentTop = parent.getBoundingClientRect().top || 0;
            let crossChildHeight = 0;
            if( child.clientHeight > parent.getBoundingClientRect().bottom ) {
                crossChildHeight = parent.getBoundingClientRect().bottom - child.clientHeight;
            }
            if( parseInt( crossChildHeight ) < 0 ) {
                parent.classList.remove( 'responsive-table__wrapper_fixed' );
                parent.classList.add( 'responsive-table__wrapper_absolute' );
            } else {
                parent.classList.remove( 'responsive-table__wrapper_absolute' );
                if( parentTop <= crossChildHeight ) {
                    parent.classList.add( 'responsive-table__wrapper_fixed' );
                    child.style.right = rightSpace + 'px';
                } else {
                    parent.classList.remove( 'responsive-table__wrapper_fixed' );
                    child.style.right = 0;
                }
            }
        }
        document.addEventListener( 'scroll', handleScroll );
    </script>
@endpush

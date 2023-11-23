<x-layouts.main title="Feed">
    <x-grid.container>
        <x-common.content class="feed">

            <x-ui.card>
                <div class="feed-item sale-item feed-item_sale">
                    <div class="feed-item__photos">
                        <div class="feed-item__main-photo">
                            <img
                                class="feed-item__img"
                                src="{{ asset('/storage/620_1.jpg') }}"
                                loading="lazy"
                                decoding="async"
                                alt="Test image"
                                title="Test image"
                            />
                        </div>
                        <div class="feed-item__additional-photos">
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ asset('/storage/620_2.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ asset('/storage/620_3.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ asset('/storage/620_3.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>
                            <div class="feed-item__additional-photo">
                                <img
                                    class="feed-item__img"
                                    src="{{ asset('/storage/620_3.jpg') }}"
                                    loading="lazy"
                                    decoding="async"
                                    alt="Test image"
                                    title="Test image"
                                />
                            </div>


                        </div>

                    </div>
                    <div class="feed-item__info">
                        <x-ui.title indent="normal">BLES00789, Resonance of Fate, Playstation 3</x-ui.title>

                        <div class="sale-item__price">
                            <div class="sale-item__price-title">Цена:</div>
                            <x-ui.tag class="sale-item__price-value" color="success" disabled="true">
                                2500RUB
                                <div class="sale-item__price-discount">-20%</div>
                            </x-ui.tag>
                            <x-ui.tag class="sale-item__price-oldvalue" color="dark" disabled="true">3000RUB</x-ui.tag>
                        </div>

                        <x-ui.specifications>
                            <x-ui.specifications.item title="Платформа">
                                <x-ui.tag color="dark">Playstation 3</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Код игры">
                                <x-ui.tag color="dark">BLES00789</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Жанр">
                                <x-ui.tag color="dark">Платформер</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Тип издания">
                                <x-ui.tag color="dark">Classic</x-ui.tag>
                            </x-ui.specifications.item>
                            <x-ui.specifications.item title="Языки">
                                Английский, Русский, Французский, Японский, Испанский
                            </x-ui.specifications.item>
                            <div class="description">
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                </p>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet atque, blanditiis consequatur deleniti dolores, eligendi eveniet harum iste magnam minima minus nobis possimus quae quo quod sit ut vel voluptates.
                                </p>
                            </div>
                        </x-ui.specifications>
                    </div>
                </div>
            </x-ui.card>

        </x-common.content>
    </x-grid.container>

    @push('scripts')
        <script type="module">

            var selects = document.getElementsByClassName("choices-select-auto");
            for (var i = 0; i < selects.length; i++) {

                new Choices(selects.item(i), {
                    itemSelectText: '',
                    searchEnabled: false,
                    shouldSort: false,
                    allowHTML: true,
                    noResultsText: '{{ __('Не найдено') }}',
                    noChoicesText: '{{ __('Больше ничего нет') }}',
                });
            }
        </script>
    @endpush
</x-layouts.main>

<x-layouts.main title="{{ $gameMediaVariation->name }}">
    <x-grid.container>

        <x-common.content class="variation">

            <x-content.variation.title :title="$gameMediaVariation->name">
                <x-content.variation.counters
                    :collection="$gameMediaVariation->collection_count"
                    :sale="$gameMediaVariation->sale_count"
                    :auction="$gameMediaVariation->auction_count"
                    :exchange="$gameMediaVariation->exchange_count"
                />
            </x-content.variation.title>

            <div class="variation__grid">
                <div class="variation__photo">
                    <x-content.variation.photos :variation ="$gameMediaVariation" />
                </div>

                <div class="variation__buttons">
                    <div class="variation__forms">
                        <x-ui.card>
                            <div x-data="addButtonsAttributes()"
                                 x-init="initButtonChoices()"
                                 class="variation__add">
                                <x-content.variation.add-buttons />
                                @include('content.variation.game.add-form-collection')
                            </div>
                        </x-ui.card>
                    </div>

                    <x-ui.card>
                        <div class="variation__specifications">
                            @include('content.variation.game.specifications')
                        </div>

                        <div class="variation__description">
                            {!!  $gameMediaVariation->description !!}
                        </div>

                        <x-ui.message type="info" >
                            <x-slot:icon class="message__icon_info">
                                <x-svg.info class="message__info-icon"></x-svg.info>
                            </x-slot:icon>
                            Мы не можем гарантировать что все данные указаны верно. Мы берем информацию из открытых источников и работаем крайне ограниченным кругом лиц. Мы будем очень рады любым дополнения, исправлениям, уточнениям с вашей стороны. Если вы хотите дополнить информацию вы можете нажать здесь и написать нам. Мы будем благодарны любой вашей помощи в наполнении данного сайта
                        </x-ui.message>
                    </x-ui.card>
                </div>

                <div class="variation__videos">
                    <x-content.variation.videos />
                </div>

                <div class="variation__relatives">
                    <x-content.variation.relatives />
                </div>

                <div class="variation__comments">
                    <x-content.variation.comments />
                </div>
            </div>

        </x-common.content>
    </x-grid.container>

    @include('content.variation.game.modals')

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

            Fancybox.bind("[data-fancybox]", {
                // Your custom options
            });

            const inputElement2 = document.querySelector('.filepond2');

            const pond2 = FilePond.create(inputElement2, {
                credits: false,
                labelIdle: '<span class="filepond--label-action"> {{ __('Загрузите') }}</span> {{ __('дополнительные фото') }}',
                labelMaxFileSizeExceeded: 'Файл слишком большой',
                labelMaxFileSize: 'Максимальный размер {filesize}',
                labelFileLoading: 'Загрузка',
                labelTapToCancel: 'отменить',
                labelFileWaitingForSize: 'подождите'
            });

            FilePond.registerPlugin(
                FilePondPluginFileValidateType,
                FilePondPluginImagePreview,
                FilePondPluginImageExifOrientation,
                FilePondPluginFileValidateSize,
                FilePondPluginImageCrop,
                FilePondPluginImageResize,
                FilePondPluginImageTransform,
            );

            const inputElement = document.querySelector('.filepond1');
            const pond = FilePond.create(inputElement, {
                credits: false,
                labelIdle: '<span class="filepond--label-action"> {{ __('Загрузите') }}</span> {{ __('главное фото') }} '
            });


            var quill = new Quill('#new-comment', {
                placeholder: 'Leave your comment',
                theme: 'snow'
            });
        </script>

        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.store('modal', {
                    hide: true,
                });
                Alpine.store('modal1', {
                    hide: true,
                });
                Alpine.store('modal2', {
                    hide: true,
                });

            })

            function handleClick(element) {
                var iframe = element.querySelector('iframe');
                if (iframe) {
                    var iframeSrc = iframe.src;
                    iframe.src = iframeSrc;
                }
            }


        </script>
    @endpush
</x-layouts.main>

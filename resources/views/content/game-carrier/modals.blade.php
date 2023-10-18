<div class="carrier__modals">
    <x-ui.modal x-data id="carrier_video1" tag="section"  ::class="$store.modal.hide ? '' : 'modal_show'">
        <x-ui.modal.content
            x-on:click.outside="$store.modal.hide = true, handleClick(carrier_video1)">

            <x-ui.modal.close x-on:click="$store.modal.hide = true, handleClick(carrier_video1)">
            </x-ui.modal.close>

            <x-ui.modal.header>
                <x-ui.title indent="normal">Видео1</x-ui.title>
            </x-ui.modal.header>

            <x-ui.modal.body>
{{--                <iframe width="560" height="315" src="https://www.youtube.com/embed/n2SWbVlzu8w?si=5iAVDmiXY6q8LYZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>--}}
            </x-ui.modal.body>

        </x-ui.modal.content>
    </x-ui.modal>

    <x-ui.modal x-data id="carrier_video2" tag="section"  ::class="$store.modal1.hide ? '' : 'modal_show'">
        <x-ui.modal.content
            x-on:click.outside="$store.modal1.hide = true, handleClick(carrier_video2)">

            <x-ui.modal.close x-on:click="$store.modal1.hide = true, handleClick(carrier_video2)">
            </x-ui.modal.close>

            <x-ui.modal.header>
                <x-ui.title indent="normal">Видео2</x-ui.title>
            </x-ui.modal.header>

            <x-ui.modal.body>
{{--                <iframe width="560" height="315" src="https://www.youtube.com/embed/n2SWbVlzu8w?si=5iAVDmiXY6q8LYZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>                --}}
            </x-ui.modal.body>

        </x-ui.modal.content>
    </x-ui.modal>

    <x-ui.modal x-data id="carrier_video3" tag="section" ::class="$store.modal2.hide ? '' : 'modal_show'">
        <x-ui.modal.content
            x-on:click.outside="$store.modal2.hide = true, handleClick(carrier_video3)">
            <x-ui.modal.close x-on:click="$store.modal2.hide = true, handleClick(carrier_video3)">
            </x-ui.modal.close>

            <x-ui.modal.header>
                <x-ui.title indent="normal">Видео3</x-ui.title>
            </x-ui.modal.header>

            <x-ui.modal.body>
{{--                <iframe width="560" height="315" src="https://www.youtube.com/embed/n2SWbVlzu8w?si=5iAVDmiXY6q8LYZk" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>                --}}
            </x-ui.modal.body>

        </x-ui.modal.content>
    </x-ui.modal>
</div>

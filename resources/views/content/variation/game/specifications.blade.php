<x-ui.specifications>
    <x-ui.specifications.item :title="trans_choice('game.platform.platforms', 2)">
        @foreach($gameMediaVariation->gameMedia->platforms as $platform)
            <x-ui.tag color="dark">{{ $platform->name }}</x-ui.tag>
        @endforeach
    </x-ui.specifications.item>
    <x-ui.specifications.item :title="trans_choice('game.genre.genres', 2)">
        @foreach($gameMediaVariation->gameMedia->genres as $genre)
            <x-ui.tag color="dark">{{ $genre->name }}</x-ui.tag>
        @endforeach
    </x-ui.specifications.item>
    <x-ui.specifications.item :title="trans_choice('game.games', 2)">
        @foreach($gameMediaVariation->gameMedia->games as $game)
            <x-ui.tag color="dark">{{ $game->name }}</x-ui.tag>
        @endforeach
    </x-ui.specifications.item>
    <x-ui.specifications.item :title="trans_choice('game.developer.developers', 2)">
        @foreach($gameMediaVariation->gameMedia->developers as $developer)
            <x-ui.tag color="dark">{{ $developer->name }}</x-ui.tag>
        @endforeach
    </x-ui.specifications.item>
    <x-ui.specifications.item :title="trans_choice('game.publisher.publishers', 2)">
        @foreach($gameMediaVariation->gameMedia->publishers as $publisher)
            <x-ui.tag color="dark">{{ $publisher->name }}</x-ui.tag>
        @endforeach
    </x-ui.specifications.item>
    <x-ui.specifications.item title="{{ trans_choice('common.article_numbers', 1) }}">
        <div>{{ $gameMediaVariation->article_number }}</div>
    </x-ui.specifications.item>
    <x-ui.specifications.item title="{{ trans_choice('common.barcodes', 2) }}">
        @foreach($gameMediaVariation->barcodes as $barcode)
            <div>{{ $barcode }}</div>
        @endforeach
    </x-ui.specifications.item>
    <x-ui.specifications.item title="{{ __('common.alternative_names') }}">
        @foreach($gameMediaVariation->alternative_names as $name)
            <div>{{ $name }}</div>
        @endforeach
    </x-ui.specifications.item>
    @if($gameMediaVariation->gameMedia->released_at)
        <x-ui.specifications.item :title="__('game.media.released_at')">
            <div>{{ $gameMediaVariation->gameMedia->released_at->format('d.m.Y') }}</div>
        </x-ui.specifications.item>
    @endif

    <x-ui.specifications.item title="Даты выхода">
        Pal: 08.09.2006, JP: 07.07.2007, NA: 12.11.2006
    </x-ui.specifications.item>
    <x-ui.specifications.item title="Тип издания">
        <x-ui.tag color="dark">Classic</x-ui.tag>
        <x-ui.tag color="dark">Essential</x-ui.tag>
        <x-ui.tag color="dark">Platinum</x-ui.tag>
        <x-ui.tag color="dark">Limited</x-ui.tag>
    </x-ui.specifications.item>
    <x-ui.specifications.item title="Языки">
        Английский, Русский, Французский, Японский, Испанский
    </x-ui.specifications.item>
</x-ui.specifications>

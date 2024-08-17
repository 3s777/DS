<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('game.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.game.partials.filters')

    <x-common.action-table model-name="games">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => trans_choice('common.name', 1),
                'users.name' => __('user.user'),
                'created_at' => __('common.created_date'),
            ]"/>

        <x-ui.responsive-table :empty="$games->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$games"/>
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" sortable="true" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="name">
                    {{ trans_choice('common.name', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="genres">
                    {{ __('game_genre.genres') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="platforms">
                    {{ __('game_platform.platforms') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="developers">
                    {{ __('game_developer.developers') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="publishers">
                    {{ __('game_publisher.publishers') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name" sortable="true">
                    {{ __('user.user') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at" sortable="true">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($games as $game)
                <x-ui.responsive-table.row>
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$game"/>
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $game->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span> {{ $game->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_genre.genres') }}: </span>
                        @foreach($game->genres as $genre)
                            {{ $genre['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_platform.platforms') }}: </span>
                        @foreach($game->platforms as $platform)
                            {{ $platform['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_developer.developers') }}: </span>
                        @foreach($game->developers as $developer)
                            {{ $developer['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_publisher.publishers') }}: </span>
                        @foreach($game->publishers as $publisher)
                            {{ $publisher['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('user.user') }}: </span> {{ $game->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span
                            class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $game->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$game" model="games"/>
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action/>
        </x-slot:footer>
    </x-common.action-table>

    {{ $games->links('pagination::default') }}

</x-layouts.admin>

<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('game.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.game.partials.filters')

    <x-common.action-table model-name="admin.games">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => trans_choice('common.name', 1),
                'users.name' => trans_choice('user.users', 1),
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
                    {{ trans_choice('game.genre.genres', 2) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="platforms">
                    {{ trans_choice('game.platform.platforms', 2) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="developers">
                    {{ trans_choice('game.developer.developers', 2) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="publishers">
                    {{ trans_choice('game.publisher.publishers', 2) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name" sortable="true">
                    {{ trans_choice('user.users', 1) }}
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
                        <span class="responsive-table__label">{{ trans_choice('game.genre.genres', 2) }}: </span>
                        @foreach($game->genres as $genre)
                            {{ $genre['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('game.platform.platforms', 2) }}: </span>
                        @foreach($game->platforms as $platform)
                            {{ $platform['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('game.developer.developers', 2) }}: </span>
                        @foreach($game->developers as $developer)
                            {{ $developer['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('game.publisher.publishers', 2) }}: </span>
                        @foreach($game->publishers as $publisher)
                            {{ $publisher['name'] }},
                        @endforeach
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('user.users', 1) }}: </span> {{ $game->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span
                            class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $game->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$game" model="admin.games"/>
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

<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        {{ __('game_genre.list') }}
    </x-ui.title>

    <x-common.action-table model-name="game-genres">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => __('common.name'),
                'users.name' => __('user.user'),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$genres->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$genres" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="name">
                    {{ __('common.name') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name">
                    {{ __('user.user') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($genres as $genre)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$genre" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $genre->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.name') }}: </span> {{ $genre->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('user.user') }}: </span> {{ $genre->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $genre->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$genre" model="game-genres" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action />
        </x-slot:footer>
    </x-common.action-table>

    {{ $genres->links('pagination::default') }}

</x-layouts.admin>

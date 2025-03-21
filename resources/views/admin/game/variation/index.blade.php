<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('collectible.variation.list') }}
        @endif
    </x-ui.title>

    @include('admin.game.variation.partials.filters')

    <x-common.action-table model-name="admin.game-medias">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => trans_choice('common.name', 1),
                'article_number' => trans_choice('common.article_numbers', 1),
                'game_medias.name' => trans_choice('user.users', 1),
                'users.name' => trans_choice('game.media.medias', 1),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$gameMediaVariations->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$gameMediaVariations" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" sortable="true" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="name">
                    {{ trans_choice('common.name', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="article_number">
                    {{ trans_choice('common.article_numbers', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="alternative_names">
                    {{ trans_choice('common.alternative_names', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="game_medias.name">
                    {{ trans_choice('game.media.medias', 1) }}
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

            @foreach($gameMediaVariations as $variation)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$variation" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $variation->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span>
                        {{ $variation->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.article_numbers', 1) }}: </span>
                        {{ $variation->article_number }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span>
                        {{ implode(', ', $variation->alternative_names) }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('game.media.medias', 1) }}: </span>
                        {{ $variation->game_media_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('user.users', 1) }}: </span> {{ $variation->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $variation->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$variation" model="admin.game-media-variations" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action />
        </x-slot:footer>
    </x-common.action-table>

    {{ $gameMediaVariations->links('pagination::default') }}

</x-layouts.admin>

<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        {{ __('game_platform.list') }}
    </x-ui.title>

    <x-common.action-table model-name="admin.game-platforms">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => trans_choice('common.name', 1),
                'users.name' => trans_choice('user.users', 1),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$platforms->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$platforms" />
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="id" name="id">
                    {{ __('common.id') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="name">
                    {{ trans_choice('common.name', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="type">
                    {{ __('game_platform.type') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="manufacturer">
                    {{ trans_choice('game_platform_manufacturer.manufacturers', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="users.name">
                    {{ trans_choice('user.users', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($platforms as $platform)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$platform" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $platform->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span> {{ $platform->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('game_platform.type') }}: </span>
                        @if($platform->type)
                            {{ $getTypeName($platform->type) }}
                        @endif
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('game_platform_manufacturer.manufacturers', 1) }}: </span>
                            {{ $platform->manufacturer_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('user.users', 1) }}: </span> {{ $platform->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $platform->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$platform" model="admin.game-platforms" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action />
        </x-slot:footer>
    </x-common.action-table>

    {{ $platforms->links('pagination::default') }}

</x-layouts.admin>

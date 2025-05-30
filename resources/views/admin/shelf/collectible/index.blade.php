<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('collectible.list') }}
        @endif
    </x-ui.title>

    @include('admin.shelf.collectible.partials.filters')

    <x-common.action-table model-name="admin.collectibles">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => trans_choice('common.name', 1),
                'article_number' => trans_choice('common.article_numbers', 1),
                'condition'  => __('common.condition'),
                'type' => trans_choice('collectible.type', 1),
                'media' => trans_choice('collectible.collectable', 1),
                'kit_score' => __('collectible.kit.items'),
                'purchase_price' => __('collectible.purchase_price'),
                'purchase_at' => __('collectible.purchased_at'),
                'seller' =>  __('collectible.seller'),
                'additional_field' => trans_choice('common.additional_fields', 1),
                'sale' => __('common.sale'),
                'auction' => __('common.auction'),
                'users.name' => trans_choice('user.collectors', 1),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$collectibles->isEmpty()">
            <x-ui.responsive-table.header>
                <x-ui.responsive-table.column type="select" name="check">
                    <x-common.action-table.select-all :models="$collectibles" />
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
                <x-ui.responsive-table.column sortable="true" name="condition">
                    {{ __('common.condition') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="category_id">
                    {{ trans_choice('collectible.type', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="collectable.name">
                    {{ trans_choice('collectible.collectable', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="kit_score">
                    {{ __('collectible.kit.items') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="purchase_price">
                    {{ __('collectible.purchase_price') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="purchased_at">
                    {{ __('collectible.purchased_at') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="seller">
                    {{ __('collectible.seller') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="additional_field">
                    {{ trans_choice('common.additional_fields', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="sale_data">
                    {{ __('common.sale') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="auction_data">
                    {{ __('common.auction') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="collectors.name">
                    {{ trans_choice('user.collectors', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="created_at" sortable="true">
                    {{ __('common.created_date') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column type="action" name="action">
                    {{ __('common.action') }}
                </x-ui.responsive-table.column>
            </x-ui.responsive-table.header>

            @foreach($collectibles as $collectible)
                <x-ui.responsive-table.row >
                    <x-ui.responsive-table.column type="select">
                        <x-common.action-table.row-checkbox :model="$collectible" />
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="id">
                        {{ $collectible->id }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.name', 1) }}: </span> {{ $collectible->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.article_numbers', 1) }}: </span> {{ $collectible->article_number }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.condition') }}: </span> {{ $getConditionName($collectible->condition) }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('collectible.type', 1) }}: </span>
{{--                        {{ $getTypeName($collectible->collectable_type) }}--}}
                        {{ $collectible->category->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('collectible.collectable', 1) }}: </span> {{ $collectible->collectable->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('collectible.kit.items') }}: </span>
                        {{ $collectible->kit_score }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('collectible.purchase_price') }}: </span> {{ $collectible->purchase_price }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('collectible.purchased_at') }}: </span> {{ $collectible->purchased_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('collectible.seller') }}: </span> {{ $collectible->seller }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('common.additional_fields', 1) }}: </span> {{ $collectible->additional_field }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.sale') }}: </span>
                        @if($collectible->target == 'sale')
                            <div>{{ __('collectible.sale.price') }}: {{ $collectible->sale?->price }}</div>
                        @endif
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.auction') }}: </span>
                        @if($collectible->target == 'auction')
                            <div>{{ __('collectible.auction.price') }}: {{ $collectible->auction?->price }}</div>
                            <div>{{ __('collectible.auction.step') }}: {{ $collectible->auction?->step }}</div>
                            <div>{{ __('collectible.auction.finished_at') }}: {{ $collectible->auction?->finished_at }}</div>
                        @endif
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('user.collectors', 1) }}: </span> {{ $collectible->collector_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $collectible->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$collectible" :slug="false" model="admin.collectibles" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action />
        </x-slot:footer>
    </x-common.action-table>

    {{ $collectibles->links('pagination::default') }}
</x-layouts.admin>

<x-layouts.admin :search="false">
    <x-ui.title size="normal" indent="big">
        @if(request('filters.search'))
            {{ __('filters.result') }} "{{ request('filters.search') }}"
        @else
            {{ __('collectible.list') }}
        @endif
    </x-ui.title>

    @include('admin.shelf.collectible.partials.filters')

    <x-common.action-table model-name="shelves">
        <x-common.selectable-order
            class="action-table__selectable-order"
            :sorters="[
                'id' => __('common.id'),
                'name' => trans_choice('common.name', 1),
                'article_number' => trans_choice('common.article_numbers', 1),
                'condition'  => __('common.condition'),
                'type' => trans_choice('collectible.type', 1),
                'media' => trans_choice('collectible.collectable', 1),
                'kit_conditions' => __('collectible.kit.items'),
                'purchase_price' => __('collectible.purchase_price'),
                'purchase_at' => __('collectible.purchased_at'),
                'seller' =>  __('collectible.seller'),
                'additional_field' => trans_choice('common.additional_fields', 1),
                'sale' => __('common.sale'),
                'auction' => __('common.auction'),
                'users.name' => trans_choice('user.users', 1),
                'created_at' => __('common.created_date'),
            ]" />

        <x-ui.responsive-table :empty="$collectibles->isEmpty()">
            <div class="cover">

            </div>
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
                <x-ui.responsive-table.column sortable="true" name="type">
                    {{ trans_choice('collectible.type', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column sortable="true" name="collectable.name">
                    {{ trans_choice('collectible.collectable', 1) }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="collectable.kit_conditions">
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
                <x-ui.responsive-table.column name="sale">
                    {{ __('common.sale') }}
                </x-ui.responsive-table.column>
                <x-ui.responsive-table.column name="auction">
                    {{ __('common.auction') }}
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
                        <span class="responsive-table__label">{{ trans_choice('collectible.type', 1) }}: </span> {{ $getTypeName($collectible->collectable_type) }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('collectible.collectable', 1) }}: </span> {{ $collectible->collectable->name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('collectible.kit.items') }}: </span>
                        @if($collectible->kit_conditions)
                            @foreach($collectible->kit_conditions as $title => $value)
                                <div>{{ $title }}: {{ $value }}</div>
                            @endforeach
                        @endif
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
                            <div>{{ __('collectible.sale_price') }}: {{ $collectible->sale['price'] }}</div>
                        @endif
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.auction') }}: </span>
                        @if($collectible->target == 'auction')
                            <div>{{ __('collectible.auction_price') }}: {{ $collectible->auction['price'] }}</div>
                            <div>{{ __('collectible.auction_step') }}: {{ $collectible->auction['step'] }}</div>
                            <div>{{ __('collectible.auction_to') }}: {{ $collectible->auction['to'] }}</div>
                        @endif
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ trans_choice('user.users', 1) }}: </span> {{ $collectible->user_name }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column>
                        <span class="responsive-table__label">{{ __('common.created_date') }}: </span> {{ $collectible->created_at }}
                    </x-ui.responsive-table.column>
                    <x-ui.responsive-table.column type="action">
                        <x-common.action-table.buttons :item="$collectible" :slug="false" model="collectibles" />
                    </x-ui.responsive-table.column>
                </x-ui.responsive-table.row>
            @endforeach
        </x-ui.responsive-table>

        <x-slot:footer>
            <x-common.action-table.selected-action />
        </x-slot:footer>
    </x-common.action-table>

    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad alias amet aperiam, aspernatur aut blanditiis consequatur dicta eius eum excepturi fugiat fugit hic, id ipsum iste iusto molestiae nam nihil non odio omnis possimus praesentium quae quas repellendus tempora voluptatibus? Accusamus architecto at aut blanditiis cum delectus deleniti dignissimos ducimus eaque earum enim eos esse excepturi exercitationem fuga illum impedit in incidunt iste iusto, laboriosam magni maxime molestiae mollitia nesciunt nihil numquam pariatur possimus praesentium quasi quisquam quos reiciendis repellendus reprehenderit sed sit suscipit. Corporis cumque deserunt distinctio doloremque eos inventore labore laudantium quae quidem, reiciendis velit voluptas. Consequatur distinctio, et eveniet facilis nemo nobis odio sunt voluptas! Ab asperiores commodi culpa et, eum eveniet facere facilis fuga hic incidunt labore laudantium minima natus nisi nobis, obcaecati quam, repellat similique sit tempora temporibus unde velit voluptate! Animi architecto at fugiat in officiis quaerat sunt! Adipisci amet beatae, consequuntur dignissimos, eaque excepturi in itaque laborum minus molestias quam, quos suscipit tempore ullam voluptate? Aliquam aliquid animi atque blanditiis corporis deserunt eius est explicabo iste laudantium minus non, perspiciatis praesentium quam quo repellendus, velit? A architecto cumque dolores ducimus iste omnis quos ratione sed. Animi autem cumque distinctio dolore doloribus dolorum error facilis hic id laudantium natus officiis quasi, recusandae repellat reprehenderit similique sit, tempora tempore velit voluptatum? Ab amet at blanditiis deserunt dolores facere hic maxime quia temporibus? Ad adipisci alias at blanditiis consequatur corporis debitis deleniti deserunt dolores doloribus earum et excepturi harum illum inventore labore libero magnam minima minus nemo nihil odit, officiis perferendis perspiciatis placeat porro praesentium provident quae qui quidem quisquam quod sint ullam vel, vero vitae voluptatum? A ad aspernatur autem consectetur consequatur exercitationem, explicabo facere illo ipsam ipsum maiores minima necessitatibus nobis obcaecati, pariatur praesentium quod sapiente sed suscipit velit! Commodi consequatur eligendi minima sequi? Maxime nostrum recusandae soluta. Accusamus aspernatur assumenda dicta distinctio itaque laboriosam modi quam tempore ullam! Atque aut corporis cumque dolorem ea enim et facere iusto labore laboriosam minus, nam natus, recusandae reiciendis sit tenetur unde veritatis voluptatum. Ad animi architecto aspernatur consequatur debitis deleniti earum, eligendi et eveniet excepturi impedit incidunt iure laboriosam minus molestias necessitatibus non nostrum officiis, quam quas quisquam quod ratione repudiandae rerum veniam! Ea eaque itaque non odio, quidem tempora. Adipisci beatae consectetur consequuntur culpa cum cupiditate dignissimos eius enim error id inventore itaque minima omnis pariatur quam quas, quis sit totam unde vel. Non optio quas saepe. Ab adipisci consequuntur, culpa dolore earum eos esse excepturi illum maiores non nostrum numquam placeat provident quaerat quia! Accusamus, aliquid aperiam assumenda consequuntur deleniti dicta dignissimos dolores eaque eligendi eum explicabo impedit incidunt itaque maiores minus molestiae molestias mollitia nesciunt non numquam omnis pariatur qui quisquam quod reprehenderit rerum similique suscipit tempora ullam, voluptatum. Ab beatae, consequuntur dicta doloribus excepturi facere fugiat inventore, itaque nesciunt placeat quis voluptatem. Doloribus esse eveniet explicabo fugit harum magnam sed voluptate. Aperiam aut dolor ea, enim error eveniet fuga fugiat iusto magnam pariatur perferendis placeat, porro quo rem sapiente sit tempore.
    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium ad alias amet aperiam, aspernatur aut blanditiis consequatur dicta eius eum excepturi fugiat fugit hic, id ipsum iste iusto molestiae nam nihil non odio omnis possimus praesentium quae quas repellendus tempora voluptatibus? Accusamus architecto at aut blanditiis cum delectus deleniti dignissimos ducimus eaque earum enim eos esse excepturi exercitationem fuga illum impedit in incidunt iste iusto, laboriosam magni maxime molestiae mollitia nesciunt nihil numquam pariatur possimus praesentium quasi quisquam quos reiciendis repellendus reprehenderit sed sit suscipit. Corporis cumque deserunt distinctio doloremque eos inventore labore laudantium quae quidem, reiciendis velit voluptas. Consequatur distinctio, et eveniet facilis nemo nobis odio sunt voluptas! Ab asperiores commodi culpa et, eum eveniet facere facilis fuga hic incidunt labore laudantium minima natus nisi nobis, obcaecati quam, repellat similique sit tempora temporibus unde velit voluptate! Animi architecto at fugiat in officiis quaerat sunt! Adipisci amet beatae, consequuntur dignissimos, eaque excepturi in itaque laborum minus molestias quam, quos suscipit tempore ullam voluptate? Aliquam aliquid animi atque blanditiis corporis deserunt eius est explicabo iste laudantium minus non, perspiciatis praesentium quam quo repellendus, velit? A architecto cumque dolores ducimus iste omnis quos ratione sed. Animi autem cumque distinctio dolore doloribus dolorum error facilis hic id laudantium natus officiis quasi, recusandae repellat reprehenderit similique sit, tempora tempore velit voluptatum? Ab amet at blanditiis deserunt dolores facere hic maxime quia temporibus? Ad adipisci alias at blanditiis consequatur corporis debitis deleniti deserunt dolores doloribus earum et excepturi harum illum inventore labore libero magnam minima minus nemo nihil odit, officiis perferendis perspiciatis placeat porro praesentium provident quae qui quidem quisquam quod sint ullam vel, vero vitae voluptatum? A ad aspernatur autem consectetur consequatur exercitationem, explicabo facere illo ipsam ipsum maiores minima necessitatibus nobis obcaecati, pariatur praesentium quod sapiente sed suscipit velit! Commodi consequatur eligendi minima sequi? Maxime nostrum recusandae soluta. Accusamus aspernatur assumenda dicta distinctio itaque laboriosam modi quam tempore ullam! Atque aut corporis cumque dolorem ea enim et facere iusto labore laboriosam minus, nam natus, recusandae reiciendis sit tenetur unde veritatis voluptatum. Ad animi architecto aspernatur consequatur debitis deleniti earum, eligendi et eveniet excepturi impedit incidunt iure laboriosam minus molestias necessitatibus non nostrum officiis, quam quas quisquam quod ratione repudiandae rerum veniam! Ea eaque itaque non odio, quidem tempora. Adipisci beatae consectetur consequuntur culpa cum cupiditate dignissimos eius enim error id inventore itaque minima omnis pariatur quam quas, quis sit totam unde vel. Non optio quas saepe. Ab adipisci consequuntur, culpa dolore earum eos esse excepturi illum maiores non nostrum numquam placeat provident quaerat quia! Accusamus, aliquid aperiam assumenda consequuntur deleniti dicta dignissimos dolores eaque eligendi eum explicabo impedit incidunt itaque maiores minus molestiae molestias mollitia nesciunt non numquam omnis pariatur qui quisquam quod reprehenderit rerum similique suscipit tempora ullam, voluptatum. Ab beatae, consequuntur dicta doloribus excepturi facere fugiat inventore, itaque nesciunt placeat quis voluptatem. Doloribus esse eveniet explicabo fugit harum magnam sed voluptate. Aperiam aut dolor ea, enim error eveniet fuga fugiat iusto magnam pariatur perferendis placeat, porro quo rem sapiente sit tempore.

    {{ $collectibles->links('pagination::default') }}
</x-layouts.admin>

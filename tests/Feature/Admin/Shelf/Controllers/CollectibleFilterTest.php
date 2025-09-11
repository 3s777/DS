<?php

namespace Admin\Shelf\Controllers;

use App\Admin\Http\Controllers\Shelf\CollectibleController;
use Database\Factories\Shelf\CollectibleFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Game\Models\GameMediaVariation;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Category;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Models\Auction;
use Domain\Trade\Models\Sale;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasFilters;
use Tests\Traits\HasSorters;

class CollectibleFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;
    use HasSorters;

    protected User $user;
    protected Category $category;
    protected Collection $collectibles;
    protected array $attributes;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->category = Category::factory()->create([
            'model' => Relation::getMorphAlias(GameMediaVariation::class)
        ]);

        $gameMediaVariation = GameMediaVariation::factory()
            ->for(GameMedia::factory(), 'gameMedia')
            ->create();

        $this->attributes = [
            'collectable_type' => 'game_media_variation',
            'collectable_id' => $gameMediaVariation->id,
            'mediable_id' => $gameMediaVariation->game_media_id,
            'mediable_type' => 'game_media',
        ];

        $this->collectibles = CollectibleFactory::new()
            ->for($this->category, 'category')
            ->count(10)
            ->create($this->attributes);
    }

    public function getFactory(): Factory
    {
        return CollectibleFactory::new()
            ->for(GameMedia::factory(), 'collectable')
            ->for($this->category, 'category');
    }

    public function getAction(): array
    {
        return [CollectibleController::class, 'index'];
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getViewData(): string
    {
        return 'collectibles';
    }

    public function getModels(): Collection
    {
        return $this->collectibles;
    }

    public function test_success_search_filtered_response(): void
    {
        $this->searchFilter(createAttributes: $this->attributes);
    }

    public function test_success_dates_from_filtered_response(): void
    {
        $this->datesFromFilter(createAttributes: $this->attributes);
    }

    public function test_success_dates_to_filtered_response(): void
    {
        $this->datesToFilter(createAttributes: $this->attributes);
    }

    public function test_success_dates_filtered_response(): void
    {
        $this->datesFilter(createAttributes: $this->attributes);
    }

    public function test_success_released_at_from_filtered_response(): void
    {
        $this->datesFromFilter('purchased_dates', 'purchased_at', createAttributes: $this->attributes);
    }

    public function test_success_released_at_to_filtered_response(): void
    {
        $this->datesToFilter('purchased_dates', 'purchased_at', createAttributes: $this->attributes);
    }

    public function test_success_released_at_filtered_response(): void
    {
        $this->datesFilter('purchased_dates', 'purchased_at', createAttributes: $this->attributes);
    }

    public function test_success_user_filtered_response(): void
    {
        $this->userFilter(createAttributes: $this->attributes);
    }

    public function test_success_collector_filtered_response(): void
    {
        $this->userFilter('collector', 'collector_id', Collector::class, createAttributes: $this->attributes);
    }

    public function test_success_search_seller_filtered_response(): void
    {
        $this->searchFilter('seller', 'seller', createAttributes: $this->attributes);
    }

    public function test_success_search_additional_field_filtered_response(): void
    {
        $this->searchFilter('additional_field', 'additional_field', createAttributes: $this->attributes);
    }

    public function test_success_kit_score_filtered_response(): void
    {
        $this->rangeFilter('kit_score', 'kit_score', createAttributes: $this->attributes);
    }

    public function test_success_kit_score_from_filtered_response(): void
    {
        $this->rangeFromFilter('kit_score', 'kit_score', createAttributes: $this->attributes);
    }

    public function test_success_kit_score_to_filtered_response(): void
    {
        $this->rangeToFilter('kit_score', 'kit_score', createAttributes: $this->attributes);
    }

    public function test_success_purchase_price_filtered_response(): void
    {
        $this->rangeFilter('purchase_price', 'purchase_price', createAttributes: $this->attributes);
    }

    public function test_success_purchase_price_from_filtered_response(): void
    {
        $this->rangeFromFilter('purchase_price', 'purchase_price', createAttributes: $this->attributes);
    }

    public function test_success_purchase_price_to_filtered_response(): void
    {
        $this->rangeToFilter('purchase_price', 'purchase_price', createAttributes: $this->attributes);
    }

    public function test_success_sale_price_filtered_response(): void
    {
        $models = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => fn () => rand(1, 5)
            ]), 'sale')
            ->count(10)
            ->create($this->attributes);

        $this->attributes['target'] = 'sale';
        $expectedModel = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => 10
            ]), 'sale')
            ->create($this->attributes);

        $request = [
            'filters' => [
               'sale_price' => [
                    'from' => 6,
                    'to' => 11
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function test_success_sale_price_from_filtered_response(): void
    {
        $models = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => fn () => rand(1, 5)
            ]), 'sale')
            ->count(10)
            ->create($this->attributes);

        $this->attributes['target'] = 'sale';
        $expectedModel = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => 10
            ]), 'sale')
            ->create($this->attributes);

        $request = [
            'filters' => [
                'sale_price' => [
                    'from' => 6
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function test_success_sale_price_to_filtered_response(): void
    {
        $models = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => fn () => rand(5, 10)
            ]), 'sale')
            ->count(10)
            ->create($this->attributes);

        $this->attributes['target'] = 'sale';
        $expectedModel = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => 3
            ]), 'sale')
            ->create($this->attributes);

        $request = [
            'filters' => [
                'sale_price' => [
                    'to' => 4
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    public function test_success_auction_finished_at_filtered_response(): void
    {
        $this->datesRelationFilter(
            Auction::class,
            'auction',
            'auction_dates',
            'finished_at',
            createAttributes: $this->attributes
        );
    }

    public function test_success_auction_finished_at_from_filtered_response(): void
    {
        $this->datesRelationFromFilter(
            Auction::class,
            'auction',
            'auction_dates',
            'finished_at',
            createAttributes: $this->attributes
        );
    }

    public function test_success_auction_finished_at_to_filtered_response(): void
    {
        $this->datesRelationToFilter(
            Auction::class,
            'auction',
            'auction_dates',
            'finished_at',
            createAttributes: $this->attributes
        );
    }



    public function test_success_category_filtered_response(): void
    {
        $expectedCategory = Category::factory()->create([
            'model' => 'test'
        ]);

        $gameMedia = GameMedia::factory()->create();

        $expectedModels = Collectible::withoutEvents(function () use ($expectedCategory, $gameMedia) {
            return Collectible::factory()
                ->count(2)
                ->for($gameMedia, 'collectable')
                ->for($expectedCategory, 'category')
                ->create($this->attributes);
        });

        $request = [
            'filters' => [
                'category' => $expectedCategory->id
            ]
        ];

        $this->actingAs($this->getUser())
            ->get(action($this->getAction(), $request))
            ->assertOk()
            ->assertViewHas($this->getViewData())
            ->assertSee($expectedModels->pluck('name')->toArray())
            ->assertDontSee($this->getModels()->pluck('name')->toArray());
    }

    public function test_success_target_filtered_response(): void
    {
        $this->valueFilter(
            'target',
            'target',
            createAttributes: $this->attributes
        );
    }

    public function test_success_condition_filtered_response(): void
    {
        $this->valueFilter(
            'condition',
            'condition',
            true,
            createAttributes: $this->attributes
        );
    }

    public function test_should_validation_filters_fail(): void
    {
        $request = [
            'filters' => [
                'dates' => ['from' => 'string', 'to' => '202222-01-01'],
                'user' => 'wrong_user',
                'collector' => 'wrong_collector',
                'condition' => 'wrong_condition',
                'category' => 'wrong_category',
                'target' => ['wrong_data'],
                'purchased_dates' => ['from' => 'string', 'to' => '202222-01-01'],
                'seller' => ['wrong_data'],
                'additional_field' => ['wrong_data'],
                'purchase_price' => ['from' => 'string', 'to' => 'string'],
                'sale_price' => ['from' => 'string', 'to' => 'string'],
                'kit_score' => ['from' => 'string', 'to' => 'string'],
                'auction_dates' => ['from' => 'string', 'to' => '202222-01-01'],
            ]
        ];

        $this->actingAs($this->user)
            ->get(action($this->getAction(), $request))
            ->assertInvalid([
                'filters.dates.from',
                'filters.dates.to',
                'filters.user',
                'filters.collector',
                'filters.condition',
                'filters.category',
                'filters.target',
                'filters.purchased_dates.from',
                'filters.purchased_dates.to',
                'filters.seller',
                'filters.additional_field',
                'filters.purchase_price.from',
                'filters.purchase_price.to',
                'filters.sale_price.from',
                'filters.sale_price.to',
                'filters.kit_score.from',
                'filters.kit_score.to',
                'filters.auction_dates.from',
                'filters.auction_dates.to',
            ])
            ->assertRedirectToRoute('admin.collectibles.index');
    }

    public function test_success_sorted_response(): void
    {
        $this->checkSortOrder('id');
        $this->checkSortOrder('name');
        $this->checkSortOrder('created_at');
        $this->checkSortOrder('article_number');
        $this->checkSortOrder('kit_score');
        $this->checkSortOrder('purchase_price');
        $this->checkSortOrder('purchased_at');
        $this->checkSortOrder('seller');
        $this->checkSortOrder('additional_field');
        $this->checkEnumSortOrder('condition', ConditionEnum::class);
        $this->checkSortOrder('collectors.name', 'collector.name', 'collector->name');
        $this->checkSortOrder('category_id', 'category_id', 'category->name');
        $this->checkSortOrder('auction_data');
        $this->checkSortOrder('sale_data');
    }
}

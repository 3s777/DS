<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\Admin\CollectibleController;
use Carbon\Carbon;
use Database\Factories\Shelf\CollectibleFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;
use Domain\Shelf\Models\Category;
use Domain\Trade\Models\Auction;
use Domain\Trade\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Traits\HasFilters;

class CollectibleFilterTest extends TestCase
{
    use RefreshDatabase;
    use HasFilters;

    protected User $user;
    protected Category $category;
    protected Collection $collectibles;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');

        $this->category = Category::factory()->create([
            'model' => Relation::getMorphAlias(GameMedia::class)
        ]);

        $this->collectibles = CollectibleFactory::new()
            ->for(GameMedia::factory(), 'collectable')
            ->for($this->category, 'category')
            ->count(10)
            ->create();
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

    /**
     * @test
     * @return void
     */
    public function it_success_search_filtered_response(): void
    {
        $this->searchFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_from_filtered_response(): void
    {
        $this->datesFromFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_to_filtered_response(): void
    {
        $this->datesToFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_filtered_response(): void
    {
        $this->datesFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_released_at_from_filtered_response(): void
    {
        $this->datesFromFilter('purchased_dates', 'purchased_at');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_released_at_to_filtered_response(): void
    {
        $this->datesToFilter('purchased_dates', 'purchased_at');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_released_at_filtered_response(): void
    {
        $this->datesFilter('purchased_dates', 'purchased_at');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_user_filtered_response(): void
    {
        $this->userFilter();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_collector_filtered_response(): void
    {
        $this->userFilter('collector', 'collector_id', Collector::class);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_search_seller_filtered_response(): void
    {
        $this->searchFilter('seller', 'seller');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_search_additional_field_filtered_response(): void
    {
        $this->searchFilter('additional_field', 'additional_field');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_kit_score_filtered_response(): void
    {
        $this->rangeFilter('kit_score', 'kit_score');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_kit_score_from_filtered_response(): void
    {
        $this->rangeFromFilter('kit_score', 'kit_score');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_kit_score_to_filtered_response(): void
    {
        $this->rangeToFilter('kit_score', 'kit_score');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_purchase_price_filtered_response(): void
    {
        $this->rangeFilter('purchase_price', 'purchase_price');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_purchase_price_from_filtered_response(): void
    {
        $this->rangeFromFilter('purchase_price', 'purchase_price');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_purchase_price_to_filtered_response(): void
    {
        $this->rangeToFilter('purchase_price', 'purchase_price');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_sale_price_filtered_response(): void
    {
        $models = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => fn() => rand(1, 5)
            ]), 'sale')
            ->count(10)
            ->create();

        $expectedModel = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => 10
            ]), 'sale')
            ->create(['target' => 'sale']);

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

    /**
     * @test
     * @return void
     */
    public function it_success_sale_price_from_filtered_response(): void
    {
        $models = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => fn() => rand(1, 5)
            ]), 'sale')
            ->count(10)
            ->create();

        $expectedModel = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => 10
            ]), 'sale')
            ->create(['target' => 'sale']);

        $request = [
            'filters' => [
                'sale_price' => [
                    'from' => 6
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_sale_price_to_filtered_response(): void
    {
        $models = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => fn() => rand(5, 10)
            ]), 'sale')
            ->count(10)
            ->create();

        $expectedModel = $this->getFactory()
            ->has(Sale::factory()->state([
                'price' => 3
            ]), 'sale')
            ->create(['target' => 'sale']);

        $request = [
            'filters' => [
                'sale_price' => [
                    'to' => 4
                ]
            ]
        ];

        $this->baseAssertion($request, $expectedModel, $models);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_auction_finished_at_filtered_response(): void
    {
        $this->datesRelationFilter(
            Auction::class,
            'auction',
            'auction_dates',
            'finished_at'
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_success_auction_finished_at_from_filtered_response(): void
    {
        $this->datesRelationFromFilter(
            Auction::class,
            'auction',
            'auction_dates',
            'finished_at'
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_success_auction_finished_at_to_filtered_response(): void
    {
        $this->datesRelationToFilter(
            Auction::class,
            'auction',
            'auction_dates',
            'finished_at'
        );
    }


//
//    /**
//     * @test
//     * @return void
//     */
//    public function it_success_games_filtered_response(): void
//    {
//        $this->relationFilter('games', Game::class, 'games');
//    }

//    /**
//     * @test
//     * @return void
//     */
//    public function it_should_validation_filters_fail(): void
//    {
//        $request = [
//            'filters' => [
//                'dates' => ['from' => 'string', 'to' => '202222-01-01'],
//                'user' => 'wrong_user',
//                'genres' => 'wrong_data',
//                'platforms' => 'wrong_data',
//                'publishers' => 'wrong_data',
//                'developers' => 'wrong_data',
//                'games' => 'wrong_data'
//            ]
//        ];
//
//        $this->actingAs($this->user)
//            ->get(action($this->getAction(), $request))
//            ->assertInvalid([
//                'filters.dates.from',
//                'filters.dates.to',
//                'filters.user',
//                'filters.genres',
//                'filters.platforms',
//                'filters.publishers',
//                'filters.developers',
//                'filters.games'
//            ])
//            ->assertRedirectToRoute('admin.game-medias.index');
//    }
//
//    /**
//     * @test
//     * @return void
//     */
//    public function it_success_sorted_response(): void
//    {
//        $request = [
//            'sort' => 'id'
//        ];
//
//        $this->actingAs($this->user)
//            ->get(action($this->getAction(), $request))
//            ->assertOk()
//            ->assertSeeInOrder(
//                $this->getModels()->sortBy('id')
//                    ->flatMap(fn ($item) => [$item->id])
//                    ->toArray()
//            );
//
//        $request = [
//            'sort' => 'name'
//        ];
//
//        $this->actingAs($this->user)
//            ->get(action($this->getAction(), $request))
//            ->assertOk()
//            ->assertSeeInOrder(
//                $this->getModels()->sortBy('name')
//                    ->flatMap(fn ($item) => [$item->name])
//                    ->toArray()
//            );
//
//        $request = [
//            'sort' => 'users.name'
//        ];
//
//        $this->actingAs($this->user)
//            ->get(action($this->getAction(), $request))
//            ->assertOk()
//            ->assertSeeInOrder(
//                $this->getModels()->sortBy('user.name')
//                    ->flatMap(fn ($item) => [$item->user->name])
//                    ->toArray()
//            );
//
//        $request = [
//            'sort' => 'created_at'
//        ];
//
//        $this->actingAs($this->user)
//            ->get(action($this->getAction(), $request))
//            ->assertOk()
//            ->assertSeeInOrder(
//                $this->getModels()->sortBy('created_at')
//                    ->flatMap(fn ($item) => [$item->created_at])
//                    ->toArray()
//            );
//    }
}

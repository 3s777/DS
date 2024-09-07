<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\GamePublisherController;
use Carbon\Carbon;
use Database\Factories\Game\GamePublisherFactory;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Game\Models\GamePublisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GamePublisherFilterTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GamePublisher $gamePublisher;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_search_filtered_response(): void
    {
        $gamePublishers = GamePublisherFactory::new()
            ->count(10)
            ->create();

        $expectedGamePublisher = GamePublisherFactory::new()
            ->create(['name' => 'search test']);

        $request = [
            'filters' => [
                'search' => 'test'
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('publishers')
            ->assertSee($expectedGamePublisher->name)
            ->assertDontSee($gamePublishers->random()->first()->name);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_from_filtered_response(): void
    {
        $gamePublishers = GamePublisherFactory::new()
            ->count(10)
            ->create(['created_at' => Carbon::yesterday()]);

        $expectedGamePublisher = GamePublisherFactory::new()
            ->create(['created_at' => Carbon::now()]);

        $request = [
            'filters' => [
                'dates' => ['from' => Carbon::now()->format('Y-m-d')]
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('publishers')
            ->assertSee($expectedGamePublisher->name)
            ->assertDontSee($gamePublishers->random()->first()->name);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_to_filtered_response(): void
    {
        $gamePublishers = GamePublisherFactory::new()
            ->count(10)
            ->create(['created_at' => Carbon::tomorrow()]);

        $expectedGamePublisher = GamePublisherFactory::new()
            ->create(['created_at' => Carbon::yesterday()]);

        $request = [
            'filters' => [
                'dates' => ['to' => Carbon::yesterday()->format('Y-m-d')]
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('publishers')
            ->assertSee($expectedGamePublisher->name)
            ->assertDontSee($gamePublishers->random()->first()->name);
    }


    /**
     * @test
     * @return void
     */
    public function it_success_dates_filtered_response(): void
    {
        $gamePublishers = GamePublisherFactory::new()
            ->count(10)
            ->create();

        $expectedGamePublisher = GamePublisherFactory::new()
            ->create(['created_at' => Carbon::yesterday()]);

        $request = [
            'filters' => [
                'dates' => ['from' => Carbon::yesterday()->format('Y-m-d'), 'to' => Carbon::yesterday()->format('Y-m-d')]
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('publishers')
            ->assertSee($expectedGamePublisher->name)
            ->assertDontSee($gamePublishers->random()->first()->name);
    }


    /**
     * @test
     * @return void
     */
    public function it_should_validation_filters_fail(): void
    {
        $request = [
            'filters' => [
                'dates' => ['from' => 'string', 'to' => '202222-01-01']
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'index'], $request))
            ->assertInvalid(['filters.dates.from', 'filters.dates.to'])
            ->assertRedirectToRoute('game-publishers.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_sorted_response(): void
    {
        $gamePublishers = GamePublisherFactory::new()
            ->count(5)
            ->create();

        $request = [
            'sort' => 'name'
        ];

        $this->actingAs($this->user)
            ->get(action([GamePublisherController::class, 'index'], $request))
            ->assertOk()
            ->assertSeeInOrder(
                $gamePublishers->sortBy('name')
                    ->flatMap(fn ($item) => [$item->name])
                    ->toArray()
            );
    }
}

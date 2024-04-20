<?php

namespace App\Game\Controllers;

use App\Http\Controllers\Game\GameDeveloperController;
use Carbon\Carbon;
use Database\Factories\Game\GameDeveloperFactory;
use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GameDeveloperFilterTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected GameDeveloper $gameDeveloper;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * @test
     * @return void
     */
    public function it_success_search_filtered_response(): void
    {
        $gameDevelopers = GameDeveloperFactory::new()
            ->count(10)
            ->create();

        $expectedGameDeveloper = GameDeveloperFactory::new()
            ->create(['name' => 'search test']);

        $request = [
            'filters' => [
                'search' => 'test'
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('developers')
            ->assertSee($expectedGameDeveloper->name)
            ->assertDontSee($gameDevelopers->random()->first()->name);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_from_filtered_response(): void
    {
        $gameDevelopers = GameDeveloperFactory::new()
            ->count(10)
            ->create(['created_at' => Carbon::yesterday()]);


        $expectedGameDeveloper = GameDeveloperFactory::new()
            ->create(['created_at' => Carbon::now()]);


        $request = [
            'filters' => [
                'dates' => ['from' => Carbon::now()->format('Y-m-d')]
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('developers')
            ->assertSee($expectedGameDeveloper->name)
            ->assertDontSee($gameDevelopers->random()->first()->name);
    }

    /**
     * @test
     * @return void
     */
    public function it_success_dates_to_filtered_response(): void
    {
        $gameDevelopers = GameDeveloperFactory::new()
            ->count(10)
            ->create(['created_at' => Carbon::tomorrow()]);


        $expectedGameDeveloper = GameDeveloperFactory::new()
            ->create(['created_at' => Carbon::yesterday()]);


        $request = [
            'filters' => [
                'dates' => ['to' => Carbon::yesterday()->format('Y-m-d')]
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('developers')
            ->assertSee($expectedGameDeveloper->name)
            ->assertDontSee($gameDevelopers->random()->first()->name);
    }


    /**
     * @test
     * @return void
     */
    public function it_success_dates_filtered_response(): void
    {
        $gameDevelopers = GameDeveloperFactory::new()
            ->count(10)
            ->create();

        $expectedGameDeveloper = GameDeveloperFactory::new()
            ->create(['created_at' => Carbon::yesterday()]);

        $request = [
            'filters' => [
                'dates' => ['from' => Carbon::yesterday()->format('Y-m-d'), 'to' => Carbon::yesterday()->format('Y-m-d')]
            ]
        ];

        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'index'], $request))
            ->assertOk()
            ->assertViewHas('developers')
            ->assertSee($expectedGameDeveloper->name)
            ->assertDontSee($gameDevelopers->random()->first()->name);
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
            ->get(action([GameDeveloperController::class, 'index'], $request))
            ->assertInvalid(['filters.dates.from', 'filters.dates.to'])
            ->assertRedirectToRoute('game-developers.index');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_sorted_response(): void
    {
        $gameDevelopers = GameDeveloperFactory::new()
            ->count(5)
            ->create();

        $request = [
            'sort' => 'name'
        ];

        $this->actingAs($this->user)
            ->get(action([GameDeveloperController::class, 'index'], $request))
            ->assertOk()
            ->assertSeeInOrder(
                $gameDevelopers->sortBy('name')
                    ->flatMap(fn($item) => [$item->name])
                    ->toArray()
            );


    }
}

<?php

namespace Support\ViewModels;

use Database\Factories\Auth\UserFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Role;
use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AsyncSelectByQueryViewModelTest extends TestCase
{
    use RefreshDatabase;
    protected Collector $collector;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        $this->collector = Collector::factory()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_get_select(): void
    {
        Shelf::factory()->create(['name' => 'TestName']);
        Shelf::factory()->create(['name' => 'PestNaming']);
        Shelf::factory(3)->create();

        $select = new AsyncSelectByQueryViewModel(
            'estNam',
            Shelf::class,
            trans_choice('shelf.choose', 1)
        );

        $expectedResult = [
            ['value' => '', 'label' => trans_choice('shelf.choose', 1), 'disabled' => true],
        ];

        $expectedShelves = Shelf::where('name', 'ilike', "%estNam%")->get();

        $this->assertCount(2, $expectedShelves);

        foreach ($expectedShelves as $shelf) {
            $expectedResult[] =  ['value' => $shelf->id, 'label' => $shelf->name];
        }

        $this->assertSame(
            $select->result(),
            $expectedResult
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_success_get_select_depended(): void
    {
        Shelf::factory()->create(['name' => 'TestName', 'collector_id' => $this->collector->id]);
        Shelf::factory(3)->create(['collector_id' => $this->collector->id]);

        $select = new AsyncSelectByQueryViewModel(
            'estNam',
            Shelf::class,
            trans_choice('shelf.choose', 1),
            ['collector_id' => $this->collector->id]
        );

        $expectedResult = [
            ['value' => '', 'label' => trans_choice('shelf.choose', 1), 'disabled' => true]
        ];

        $expectedShelf = Shelf::where('name', 'TestName')->first();

        $expectedResult[] =  ['value' => $expectedShelf->id, 'label' => $expectedShelf->name];

        $this->assertSame(
            $select->result(),
            $expectedResult
        );
    }

    /**
     * @test
     * @return void
     */
    public function it_fail_get_select_wrong_depended(): void
    {
        Shelf::factory()->create(['name' => 'TestName', 'collector_id' => $this->collector->id]);
        Shelf::factory(3)->create(['collector_id' => $this->collector->id]);

        $select = new AsyncSelectByQueryViewModel(
            'estNam',
            Shelf::class,
            trans_choice('shelf.choose', 1),
            ['wrong_model_id' => $this->collector->id]
        );

        $expectedResult = [
            ['value' => '', 'label' => trans_choice('shelf.choose', 1), 'disabled' => true],
            ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true]
        ];

        $this->assertSame(
            $select->result(),
            $expectedResult
        );
    }
}

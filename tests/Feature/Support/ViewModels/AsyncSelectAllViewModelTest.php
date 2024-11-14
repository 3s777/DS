<?php

namespace Support\ViewModels;

use Database\Factories\UserFactory;
use Domain\Auth\Models\Role;
use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AsyncSelectAllViewModelTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = UserFactory::new()->create();
        Role::create(['name' => config('settings.super_admin_role'), 'display_name' => 'SuperAdmin']);
        $this->user->assignRole('super_admin');
    }

    /**
     * @test
     * @return void
     */
    public function it_success_get_select_depended(): void
    {
        $shelves = Shelf::factory(3)->create(['user_id' => $this->user->id]);

        $select = new AsyncSelectAllViewModel(
            Shelf::class,
            trans_choice('shelf.choose', 1),
            ['user_id' => $this->user->id]
        );

        $expectedResult = [
            ['value' => '', 'label' => trans_choice('shelf.choose', 1), 'disabled' => true]
        ];

        foreach($shelves as $shelf) {
            $expectedResult[] =  ['value' => $shelf->id, 'label' => $shelf->name];
        }

        $this->assertEquals(
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
        Shelf::factory(3)->create(['user_id' => $this->user->id]);

        $select = new AsyncSelectAllViewModel(
            Shelf::class,
            trans_choice('shelf.choose', 1),
            ['wrong_model_id' => $this->user->id]
        );

        $expectedResult = [
            ['value' => '', 'label' => trans_choice('shelf.choose', 1), 'disabled' => true],
            ['value' => 'not_found', 'label' => __('common.not_found'), 'disabled' => true]
        ];

        $this->assertEquals(
            $select->result(),
            $expectedResult
        );
    }
}
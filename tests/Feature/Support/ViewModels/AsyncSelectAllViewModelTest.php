<?php

namespace Support\ViewModels;

use Domain\Shelf\Models\KitItem;
use Domain\Shelf\Models\Shelf;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AsyncSelectAllViewModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function it_success_get_select(): void
    {
        $createRequest = new Request(['test' => 'sdf']);

        $select = new AsyncSelectAllViewModel(
            Shelf::class,
            trans_choice('shelf.choose', 1),
            true
        );

        dd($select);
    }
}

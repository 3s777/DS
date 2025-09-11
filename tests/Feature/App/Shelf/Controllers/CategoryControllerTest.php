<?php

namespace App\Shelf\Controllers;

use App\Http\Controllers\Shelf\CategoryController;
use Database\Factories\Shelf\CategoryFactory;
use Domain\Auth\Models\User;
use Domain\Shelf\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;
    protected Category $category;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->category = CategoryFactory::new()->create(['model' => 'game_media_variation']);
    }

    public function test_show_success(): void
    {
        $this->get(action([CategoryController::class, 'show'], ['category' => $this->category]))
            ->assertOk()
            ->assertSee(__('game.media.list'))
            ->assertViewIs('content.category.game.index');
    }

    public function test_variations_success(): void
    {
        $this->get(action([CategoryController::class, 'variations'], ['category' => $this->category]))
            ->assertOk()
            ->assertSee(__('game.variation.list'))
            ->assertViewIs('content.category.game.variations');
    }
}

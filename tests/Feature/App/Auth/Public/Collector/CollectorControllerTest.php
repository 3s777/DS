<?php

namespace App\Auth\Public\Collector;

use App\Http\Controllers\Auth\Public\Collector\CollectorController;
use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CollectorControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $authUser;
    protected Collector $testingCollector;
    protected array $request;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('images');

        $this->authCollector = CollectorFactory::new()->create();

        $this->testCollector = CollectorFactory::new()->create();

        $this->testingCollector = CollectorFactory::new()->create();
    }

    public function test_search_success(): void
    {
        $this->get(action([CollectorController::class, 'index']))
            ->assertOk()
            ->assertSee(__('user.collector.list'))
            ->assertViewIs('content.collector.search');
    }

    public function test_show_success(): void
    {
        $this->get(action([CollectorController::class, 'show'], $this->testCollector->slug))
            ->assertOk()
            ->assertSee($this->testCollector->username)
            ->assertViewIs('content.collector.index');
    }

    public function test_collection_success(): void
    {
        $this->get(action([CollectorController::class, 'showCollection'], $this->testCollector->slug))
            ->assertOk()
            ->assertSee($this->testCollector->username)
            ->assertViewIs('content.collector.collection');
    }

    public function test_sale_success(): void
    {
        $this->get(action([CollectorController::class, 'showSale'], $this->testCollector->slug))
            ->assertOk()
            ->assertSee($this->testCollector->username)
            ->assertViewIs('content.collector.sale');
    }

    public function test_auction_success(): void
    {
        $this->get(action([CollectorController::class, 'showAuction'], $this->testCollector->slug))
            ->assertOk()
            ->assertSee($this->testCollector->username)
            ->assertViewIs('content.collector.auction');
    }

    public function test_wishlist_success(): void
    {
        $this->get(action([CollectorController::class, 'showWishlist'], $this->testCollector->slug))
            ->assertOk()
            ->assertSee($this->testCollector->username)
            ->assertViewIs('content.collector.wishlist');
    }

    public function test_exchange_success(): void
    {
        $this->get(action([CollectorController::class, 'showExchange'], $this->testCollector->slug))
            ->assertOk()
            ->assertSee($this->testCollector->username)
            ->assertViewIs('content.collector.exchange');
    }

    public function test_blog_success(): void
    {
        $this->get(action([CollectorController::class, 'showBlog'], $this->testCollector->slug))
            ->assertOk()
            ->assertSee($this->testCollector->username)
            ->assertViewIs('content.collector.blog');
    }
}

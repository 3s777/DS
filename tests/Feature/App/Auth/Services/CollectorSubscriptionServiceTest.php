<?php

namespace App\Auth\Services;

use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Models\Collector;
use Domain\Auth\Services\CollectorSubscriptionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CollectorSubscriptionServiceTest extends TestCase
{
    use RefreshDatabase;

    protected Collector $authCollector;
    protected Collector $collector;
    protected Collector $subscriber;

    protected CollectorSubscriptionService $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->authCollector = CollectorFactory::new()->create();

        $this->collector = CollectorFactory::new()->create();

        $this->subscriber = CollectorFactory::new()->create();

        $this->service = new CollectorSubscriptionService();
    }


    public function testSubscribedSuccess(): void
    {
        $this->assertFalse($this->collector
            ->subscribers()
            ->where('subscriber_id', $this->subscriber->id)
            ->exists());

        $this->assertTrue($this->service->subscribe($this->collector, $this->subscriber));

        $this->assertTrue($this->collector
            ->subscribers()
            ->where('subscriber_id', $this->subscriber->id)
            ->exists());
    }

    public function testUnsubscribedSuccess(): void
    {
        $this->collector->subscribers()->attach($this->subscriber);

        $this->assertTrue($this->collector
            ->subscribers()
            ->where('subscriber_id', $this->subscriber->id)
            ->exists());

        $this->assertTrue($this->service->unsubscribe($this->collector, $this->subscriber));

        $this->assertFalse($this->collector
            ->subscribers()
            ->where('subscriber_id', $this->subscriber->id)
            ->exists());
    }

    public function testSelfSubscriptionFailed(): void
    {
        $this->assertFalse($this->service->subscribe($this->collector, $this->collector));
        $this->assertFalse($this->service->unsubscribe($this->collector, $this->collector));
    }

    public function testAuthSubscriptionSuccess(): void
    {
        $this->assertFalse($this->collector
            ->subscribers()
            ->where('subscriber_id', $this->authCollector->id)
            ->exists());

        $this->actingAs($this->authCollector, 'collector');

        $service = new CollectorSubscriptionService();

        $this->assertTrue($service->subscribe($this->collector));

        $this->assertTrue($this->collector
            ->subscribers()
            ->where('subscriber_id', $this->authCollector->id)
            ->exists());

        $this->assertTrue($service->unsubscribe($this->collector));

        $this->assertFalse($this->collector
            ->subscribers()
            ->where('subscriber_id', $this->authCollector->id)
            ->exists());
    }
}

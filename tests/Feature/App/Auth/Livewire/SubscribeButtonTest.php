<?php

namespace App\Auth\Livewire;

use App\Livewire\SubscribeButton;
use Database\Factories\Auth\CollectorFactory;
use Domain\Auth\Models\Collector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SubscribeButtonTest extends TestCase
{
    use RefreshDatabase;

    protected Collector $authCollector;
    protected Collector $testingCollector;

    public function setUp(): void
    {
        parent::setUp();

        $this->authCollector = CollectorFactory::new()->create();

        $this->testingCollector = CollectorFactory::new()->create();
    }

    public function testRendersSuccessfully(): void
    {
        Livewire::test(SubscribeButton::class, ['collector' => $this->testingCollector])
            ->assertViewIs('livewire.subscribe-button')
            ->assertStatus(200);
    }

    public function testSubscribeSuccessfully(): void
    {
        $this->assertFalse($this->authCollector
            ->subscriptions()
            ->where('collector_id', $this->testingCollector->id)
            ->exists());

        Livewire::actingAs($this->authCollector, 'collector')
            ->test(SubscribeButton::class, ['collector' => $this->testingCollector])
            ->call('subscribe')
            ->assertDispatched('subscribed')
            ->assertSet('isSubscribed', true);

        $this->assertTrue($this->authCollector
            ->subscriptions()
            ->where('collector_id', $this->testingCollector->id)
            ->exists());
    }

    public function testUnsubscribeSuccessfully(): void
    {
        $this->authCollector->subscriptions()->attach($this->testingCollector);

        $this->assertTrue($this->authCollector
            ->subscriptions()
            ->where('collector_id', $this->testingCollector->id)
            ->exists());

        Livewire::actingAs($this->authCollector, 'collector')
            ->test(SubscribeButton::class, ['collector' => $this->testingCollector])
            ->call('unsubscribe')
            ->assertDispatched('unsubscribed')
            ->assertSet('isSubscribed', false);

        $this->assertFalse($this->authCollector
            ->subscriptions()
            ->where('collector_id', $this->testingCollector->id)
            ->exists());
    }

    public function testNotAuthFailed(): void
    {
        Livewire::test(SubscribeButton::class, ['collector' => $this->testingCollector])
            ->call('unsubscribe')
            ->assertRedirectToRoute('collector.login');

        Livewire::test(SubscribeButton::class, ['collector' => $this->testingCollector])
            ->call('subscribe')
            ->assertRedirectToRoute('collector.login');
    }
}

<?php

namespace App\Livewire;

use Domain\Auth\Models\Collector;
use Domain\Auth\Services\CollectorSubscriptionService;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Locked;
use Livewire\Component;

class SubscribeButton extends Component
{

    public Collector $collector;
    #[Locked]
    public bool $isSubscribed = false;

    public function mount($collector) {
        $this->collector = $collector;

        $this->isSubscribed = auth('collector')->user()
            ->subscriptions()
            ->where('collector_id', $collector->id)
            ->exists();
    }

    public function boot() {
        if(!Auth::guard('collector')->check()) {
            $this->redirect('login');
        }
    }

    public function subscribe(CollectorSubscriptionService $service): bool
    {
        if($this->isSubscribed) {
            return true;
        }

        if($service->subscribe($this->collector)) {
            $this->isSubscribed = true;
            $this->dispatch('subscribed', collector_id: $this->collector->id);
        }

        return $this->isSubscribed;
    }

    public function unsubscribe(CollectorSubscriptionService $service): bool
    {
        if (!$this->isSubscribed) {
            return false;
        }

        if($service->unsubscribe($this->collector)) {
            $this->isSubscribed = false;
            $this->dispatch('unsubscribed', collector_id: $this->collector->id);
        }

        return $this->isSubscribed;
    }

    public function render()
    {
        return view('livewire.subscribe-button');
    }
}

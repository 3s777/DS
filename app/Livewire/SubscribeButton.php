<?php

namespace App\Livewire;

use Domain\Auth\Models\Collector;
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

        $this->isSubscribed = auth('collector')->user()->subscriptions->contains($collector);

        if(!Auth::guard('collector')->check()) {
            return $this->redirect('login');
        }
    }

    public function subscribe(): ?bool
    {
        $this->collector->subscribers()->attach(auth('collector')->user());
        $this->isSubscribed = true;

        $this->dispatch('subscribed', collector_id: $this->collector->id);

        return $this->isSubscribed;
    }

    public function unsubscribe(): ?bool
    {
        $this->collector->subscribers()->detach(auth('collector')->user());
        $this->isSubscribed = false;

        $this->dispatch('unsubscribed', collector_id: $this->collector->id);

        return $this->isSubscribed;
    }

    public function render()
    {
        return view('livewire.subscribe-button');
    }
}

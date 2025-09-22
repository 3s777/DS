<?php

namespace App\Livewire;

use Domain\Auth\Models\Collector;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SubscribeButton extends Component
{

    public Collector $collector;
    public bool $isSubscribed = false;

    public function mount($collector) {
        $this->collector = $collector;

        if(!Auth::guard('collector')->check()) {
            return $this->redirect('login');
        }
    }

    public function subscribe(): ?bool
    {
        $this->collector->subscribers()->attach(auth('collector')->user());
        $this->isSubscribed = true;

        return $this->isSubscribed;
    }

    public function unsubscribe(): ?bool
    {
        $this->collector->subscribers()->detach(auth('collector')->user());
        $this->isSubscribed = false;

        return $this->isSubscribed;
    }

    public function render()
    {
        return view('livewire.subscribe-button');
    }
}

<?php

namespace App\Livewire;

use Domain\Auth\Models\Collector;
use Livewire\Component;

class SubscribeButton extends Component
{

    public Collector $collector;
    public bool $isSubscribed = false;

    public function mount($collector) {
        $this->collector = $collector;
    }

    public function subscribe() {
        $this->collector->subscribers()->attach(auth('collector')->user());
        $this->isSubscribed = true;
    }

    public function render()
    {
        return view('livewire.subscribe-button');
    }
}

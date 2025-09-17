<?php

namespace App\Livewire;

use Domain\Auth\Models\Collector;
use Livewire\Component;

class SubscribeButton extends Component
{

    public Collector $collector;

    public function mount($collector) {
        $this->collector = $collector;
    }

    public function subscribe() {
        $this->collector->subscribers()->attach(auth('collector')->user());
    }

    public function render()
    {
        return view('livewire.subscribe-button');
    }
}

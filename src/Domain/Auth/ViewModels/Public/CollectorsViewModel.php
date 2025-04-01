<?php

namespace Domain\Auth\ViewModels\Public;

use Domain\Auth\Models\Collector;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class CollectorsViewModel extends ViewModel
{
    public function collectors(): Collection
    {
        return Collector::all();
    }
}

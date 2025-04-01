<?php

namespace Domain\Auth\ViewModels\Public;

use Domain\Auth\Models\Collector;
use Spatie\ViewModels\ViewModel;

class CollectorProfileViewModel extends ViewModel
{
    public function collector(): Collector
    {
        return auth('collector')->user()->loadCount(['shelves', 'collectibles']);
    }
}

<?php

namespace Admin\Auth\ViewModels;

use Domain\Auth\Models\Collector;
use Spatie\ViewModels\ViewModel;

class CollectorIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function collectors()
    {
        return Collector::query()
            ->select('collectors.id', 'collectors.name', 'collectors.slug', 'collectors.first_name', 'collectors.created_at', 'collectors.email')
            ->filteredAdmin()
            ->sorted()
            ->paginate(50)
            ->withQueryString();
    }
}

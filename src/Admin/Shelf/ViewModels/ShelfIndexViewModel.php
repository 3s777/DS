<?php

namespace Admin\Shelf\ViewModels;

use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;

class ShelfIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function shelves()
    {
        return Shelf::query()
            ->select('shelves.id', 'shelves.name', 'shelves.number', 'shelves.created_at', 'shelves.collector_id', 'collectors.name as collector_name')
            ->join('collectors', 'collectors.id', '=', 'shelves.collector_id')
            ->filteredAdmin()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}

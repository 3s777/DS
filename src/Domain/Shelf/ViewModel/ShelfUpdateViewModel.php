<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedCollector;

class ShelfUpdateViewModel extends ViewModel
{
    use HasSelectedCollector;

    public ?Shelf $shelf;

    public function __construct(Shelf $shelf = null)
    {
        $this->shelf = $shelf;
    }

    public function shelf(): ?Shelf
    {
        return $this->shelf ?? null;
    }

    public function selectedCollector(): array
    {
        return $this->getSelectedCollector($this->shelf);
    }
}

<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Models\KitItem;
use Spatie\ViewModels\ViewModel;

class KitItemUpdateViewModel extends ViewModel
{
    public ?KitItem $kitItem;

    public function __construct(KitItem $kitItem = null)
    {
        $this->kitItem = $kitItem;
    }

    public function kitItem(): ?KitItem
    {
        return $this->kitItem ?? null;
    }
}

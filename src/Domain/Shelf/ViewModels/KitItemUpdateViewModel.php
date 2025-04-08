<?php

namespace Domain\Shelf\ViewModels;

use Domain\Shelf\Models\KitItem;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class KitItemUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?KitItem $kitItem;

    public function __construct(KitItem $kitItem = null)
    {
        $this->kitItem = $kitItem;
    }

    public function kitItem(): ?KitItem
    {
        return $this->kitItem ?? null;
    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->kitItem);
    }
}

<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;

class ShelfUpdateViewModel extends ViewModel
{
    public ?Shelf $shelf;

    public function __construct(Shelf $shelf = null)
    {
        $this->shelf = $shelf;
    }

    public function shelf(): ?Shelf
    {
        return $this->shelf ?? null;
    }

    public function selectedUser(): array {
        $selectedUser = [];
        if($this->shelf?->user) {
           $selectedUser = [
               'key' => $this->shelf->user->id,
               'value' => $this->shelf->user->name,
           ];
        }

        return $selectedUser;
    }
}

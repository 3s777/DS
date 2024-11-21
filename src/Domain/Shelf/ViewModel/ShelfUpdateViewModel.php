<?php

namespace Domain\Shelf\ViewModel;

use Domain\Shelf\Models\Shelf;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedUser;

class ShelfUpdateViewModel extends ViewModel
{
    use HasSelectedUser;

    public ?Shelf $shelf;

    public function __construct(Shelf $shelf = null)
    {
        $this->shelf = $shelf;
    }

    public function shelf(): ?Shelf
    {
        return $this->shelf ?? null;
    }

//    public function selectedUser(): array {
//        $selectedUser = [];
//        if($this->shelf?->user) {
//           $selectedUser = [
//               'key' => $this->shelf->user->id,
//               'value' => $this->shelf->user->name,
//           ];
//        }
//
//        return $selectedUser;
//    }

    public function selectedUser(): array
    {
        return $this->getSelectedUser($this->shelf);
    }
}

<?php

namespace Domain\Shelf\ViewModel;

use Domain\Auth\Models\User;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Collectible;
use Domain\Shelf\Models\Shelf;
use Illuminate\Database\Eloquent\Collection;
use Spatie\ViewModels\ViewModel;

class CollectibleUpdateViewModel extends ViewModel
{
    public ?Collectible $collectible;

    public function __construct(Collectible $collectible = null)
    {
        $this->collectible = $collectible;
    }

    public function conditions(): array
    {
        return ConditionEnum::cases();
    }

    public function types(): array
    {
        return CollectibleTypeEnum::cases();
    }

    public function shelves(): Collection
    {
        return Shelf::where('user_id', auth()->user()->id)->get();
    }

    public function collectible(): ?Collectible
    {
        return $this->collectible ?? null;
    }

    public function selectedUser(): array {
        $selectedUser = [];
        if($this->collectible?->user) {
            $selectedUser = [
                'key' => $this->collectible->user->id,
                'value' => $this->collectible->user->name,
            ];
        }

        return $selectedUser;
    }

    public function selectedShelf(): array {
        $selectedShelf = [];
        if($this->collectible?->shelf) {
            $selectedUser = [
                'key' => $this->collectible->shelf->id,
                'value' => $this->collectible->shelf->name,
            ];
        }

        return $selectedShelf;
    }

    public function users()
    {
        return User::limit(3)->get()->pluck('name', 'id')->toArray();
    }
}

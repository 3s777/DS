<?php

namespace Domain\Shelf\ViewModel;

use Domain\Auth\Models\User;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Collectible;
use Spatie\ViewModels\ViewModel;
use Support\Traits\HasSelectedCollector;

class CollectibleUpdateViewModel extends ViewModel
{
    use HasSelectedCollector;

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

//    public function shelves(): Collection
//    {
//        return Shelf::where('user_id', auth()->user()->id)->get();
//    }

    public function collectible(): ?Collectible
    {
        return $this->collectible ?? null;
    }

//    public function selectedUser(): array {
//        $selectedUser = [];
//        if($this->collectible?->user) {
//            $selectedUser = [
//                'key' => $this->collectible->user->id,
//                'value' => $this->collectible->user->name,
//            ];
//        }
//
//        return $selectedUser;
//    }

    public function selectedCollector(): array
    {
        return $this->getSelectedCollector($this->collectible);
    }

//    public function users()
//    {
//        return User::limit(3)->get()->pluck('name', 'id')->toArray();
//    }
}

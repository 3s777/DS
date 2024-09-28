<?php

namespace Domain\Shelf\ViewModel;

use App\Enums\ConditionEnum;
use Domain\Auth\Models\User;
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

    public function shelves(): Collection
    {
        return Shelf::where('user_id', auth()->user()->id)->get();
    }

    public function collectible(): ?Collectible
    {
        return $this->collectible ?? null;
    }

    public function users()
    {
        return User::limit(3)->get()->pluck('name', 'id')->toArray();
    }
}

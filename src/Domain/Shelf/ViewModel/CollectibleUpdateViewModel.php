<?php

namespace Domain\Shelf\ViewModel;

use Domain\Settings\Models\Country;
use Domain\Shelf\Enums\CollectibleTypeEnum;
use Domain\Shelf\Enums\ConditionEnum;
use Domain\Shelf\Models\Collectible;
use Domain\Trade\Enums\ReservationEnum;
use Domain\Trade\Enums\ShippingEnum;
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


    public function countries(): array
    {
        return Country::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function selectedShippingCountries(): array
    {
        return match($this->collectible?->target) {
            'sale' => $this->collectible->sale?->shippingCountries->pluck('id')->toArray(),
            'auction' => $this->collectible?->auction?->shippingCountries->pluck('id')->toArray(),
            default => []
        };
    }

    public function selectedCountry(): bool|int
    {
        return match($this->collectible?->target) {
            'sale' => $this->collectible->sale?->country_id,
            'auction' => $this->collectible->auction?->country_id,
            default => false
        };
    }

    public function shipping(): array
    {
        return ShippingEnum::cases();
    }

    public function selectedShipping(): bool|string
    {
        return match($this->collectible?->target) {
            'sale' => $this->collectible->sale?->shipping,
            'auction' => $this->collectible->auction?->shipping,
            default => false
        };
    }

    public function selectedSelfDelivery(): bool
    {
        return match($this->collectible?->target) {
            'sale' => $this->collectible->sale?->self_delivery,
            'auction' => $this->collectible->auction?->self_delivery,
            default => false
        };
    }

    public function reservation(): array
    {
        return ReservationEnum::cases();
    }
}

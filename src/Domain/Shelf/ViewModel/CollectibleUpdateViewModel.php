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

    public function collectible(): ?Collectible
    {
        return $this->collectible ?? null;
    }

    public function countries(): array
    {
        return Country::select('id', 'name')->get()->pluck('name', 'id')->toArray();
    }

    public function shipping(): array
    {
        return ShippingEnum::cases();
    }

    public function reservation(): array
    {
        return ReservationEnum::cases();
    }

    private function tradeModel()
    {
        return match($this->collectible?->target) {
            'sale' => $this->collectible->sale,
            'auction' => $this->collectible->auction,
            default => false
        };
    }

    public function selectedCountry(): bool|int
    {
        return $this->tradeModel() ? $this->tradeModel()->country_id : false;
    }

    public function selectedShipping(): bool|string
    {
        return $this->tradeModel() ? $this->tradeModel()->shipping : false;
    }

    public function selectedShippingCountries(): array
    {
        return $this->tradeModel() ? $this->tradeModel()->shippingCountries->pluck('id')->toArray() : [];
    }

    public function selectedSelfDelivery(): bool
    {
        return $this->tradeModel() ? $this->tradeModel()->self_delivery : true;
    }

    public function selectedCollector(): array
    {
        return $this->getSelectedCollector($this->collectible);
    }
}

<?php

namespace Domain\Settings\ViewModels;

use Domain\Settings\Models\Country;
use Spatie\ViewModels\ViewModel;

class CountryUpdateViewModel extends ViewModel
{
    public ?Country $country;

    public function __construct(Country $country = null)
    {
        $this->country = $country;
    }

    public function country(): ?Country
    {
        return $this->country ?? null;
    }
}

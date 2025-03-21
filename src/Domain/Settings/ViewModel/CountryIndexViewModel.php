<?php

namespace Domain\Settings\ViewModel;

use Domain\Settings\Models\Country;
use Spatie\ViewModels\ViewModel;

class CountryIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function countries()
    {
        return Country::query()
            ->select('countries.id', 'countries.name', 'countries.slug', 'countries.created_at')
            ->orderBy('id', 'DESC')
            ->get();
    }
}

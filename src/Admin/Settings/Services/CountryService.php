<?php

namespace Admin\Settings\Services;

use Admin\Settings\DTOs\FillCountryDTO;
use Domain\Settings\Models\Country;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class CountryService
{
    public function create(FillCountryDTO $data): Country
    {
        return Transaction::run(
            function () use ($data) {
                $country = Country::create([
                    'name' => $data->name,
                    'slug' => $data->slug,
                ]);

                return $country;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }

    public function update(Country $country, FillCountryDTO $data): Country
    {
        return Transaction::run(
            function () use ($country, $data) {
                $country->fill(
                    [
                        'name' => $data->name,
                        'slug' => $data->slug,
                    ]
                )->save();

                return $country;
            },
            function (Throwable $e) {
                throw new CrudException($e->getMessage());
            }
        );
    }
}

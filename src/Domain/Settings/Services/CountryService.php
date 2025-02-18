<?php namespace Domain\Settings\Services;

use Domain\Settings\DTOs\FillCountryDTO;
use Domain\Settings\Models\Country;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Throwable;

class CountryService
{
    public function create(FillCountryDTO $data): Country
    {
        try {
            DB::beginTransaction();

            $country = Country::create([
                'name' => $data->name,
                'slug' => $data->slug,
            ]);

            DB::commit();

            return $country;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }

    public function update(Country $country, FillCountryDTO $data): Country
    {
        try {
            DB::beginTransaction();

            $country->fill(
                [
                    'name' => $data->name,
                    'slug' => $data->slug,
                ]
            )->save();

            DB::commit();

            return $country;

        } catch (Throwable $e) {
            throw new CrudException($e->getMessage());
        }
    }
}

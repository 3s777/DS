<?php

namespace Domain\Auth\Services;

use Domain\Auth\Actions\VerifyEmailAction;
use Domain\Auth\DTOs\UpdateCollectorProfileDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Collector;
use Domain\Game\DTOs\FillGameDTO;
use Domain\Game\Models\Game;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\DB;
use Support\Exceptions\CrudException;
use Throwable;

class CollectorProfileService
{
    public function update(UpdateCollectorProfileDTO $data): Authenticatable
    {
        try {
            DB::beginTransaction();

            $collector = Collector::find(auth('collector')->user()->id);

            $collector->updateFeaturedImage($data->featured_image, $data->featured_image_uploaded, ['small', 'medium']);

            $collector->fill([
                'language' => $data->language,
                'first_name' => $data->first_name,
                'description' => $data->description
            ]);

//            if ($data->password) {
//                auth('collector')->user()->password = bcrypt($data->password);
//            }





            $collector->save();


            DB::commit();
            return $collector;
        } catch (Throwable $e) {
            throw new UserCreateEditException($e->getMessage());
        }
    }
}

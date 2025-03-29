<?php

namespace Domain\Auth\Services;

use Domain\Auth\DTOs\UpdateCollectorProfileDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Collector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\HigherOrderTapProxy;
use Support\Exceptions\CrudException;
use Support\Transaction;
use Throwable;

class CollectorProfileService
{
    public function update(UpdateCollectorProfileDTO $data): Collector|HigherOrderTapProxy
    {
        return Transaction::run(function () use ($data) {

                $collector = auth('collector')->user();

                $collector->updateFeaturedImage($data->featured_image, $data->featured_image_uploaded, ['small', 'medium']);

                $collector->fill([
                    'language' => $data->language,
                    'first_name' => $data->first_name,
                    'description' => $data->description
                ]);

                if ($data->new_password) {
                    if (Hash::check($data->current_password, $collector->password)) {
                        $collector->password = bcrypt($data->new_password);
                    }
                }

                $collector->save();
                return $collector;
            },
            function (Throwable $e) {
                throw new UserCreateEditException($e->getMessage());
            }
        );
    }
}

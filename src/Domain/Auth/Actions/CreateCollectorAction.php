<?php

namespace Domain\Auth\Actions;

use Domain\Auth\DTOs\NewCollectorDTO;
use Domain\Auth\Exceptions\UserCreateEditException;
use Domain\Auth\Models\Collector;
use Illuminate\Auth\Events\Registered;
use Support\Transaction;
use Throwable;

class CreateCollectorAction
{
    public function __invoke(NewCollectorDTO $data): ?Collector
    {
        return Transaction::run(
            function () use ($data) {
                $collector = Collector::create([
                    'name' => $data->name,
                    'email' => $data->email,
                    'password' => bcrypt($data->password),
                    'language' => $data->language,
                    'first_name' => $data->first_name,
                    'slug' => $data->slug,
                    'description' => $data->description
                ]);

                event(new Registered($collector));

                if ($data->is_verified) {
                    $verifyAction = app(VerifyEmailAction::class);
                    $verifyAction($collector);
                }

                $collector->audit(
                    'changeRole',
                    [],
                    ['roles' => $data->roles]
                );

                $collector->syncRoles($data->roles);

                if ($data->featured_image) {
                    $collector->addFeaturedImageWithThumbnail(
                        $data->featured_image,
                        ['small', 'medium']
                    );
                }
                return $collector;
            },
            function (Throwable $e) {
                throw new UserCreateEditException($e->getMessage());
            }
        );
    }
}

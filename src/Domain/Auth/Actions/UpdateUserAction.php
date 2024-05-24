<?php

namespace Domain\Auth\Actions;

use Domain\Auth\DTOs\UpdateUserDTO;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;

class UpdateUserAction
{
    public function __invoke(UpdateUserDTO $data, User $user): User
    {
        if($data->thumbnail) {
            $user->updateThumbnail($data->thumbnail, $data->thumbnail_uploaded, ['small', 'medium']);

            $user->addImageWithThumbnail(
                $data->thumbnail,
                'thumbnail',
                ['small', 'medium']
            );
        }

        $user = User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => bcrypt($data->password),
            'language_id' => $data->language_id,
            'first_name' => $data->first_name,
            'slug' => $data->language_id,
            'description' => $data->description,
        ]);



//        $user->fill($request->safe()->except(['thumbnail', 'thumbnail_uploaded', 'password']))->save();



        event(new Registered($user));

        return $user;
    }
}

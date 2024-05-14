<?php

namespace App\ViewModels\User;

use Domain\Auth\Models\User;
use Spatie\ViewModels\ViewModel;

class UserListSelectViewModel extends ViewModel
{
    public function __construct(protected null|string $query)
    {
    }

    public function result(): array
    {
        $result = [
            ['value' => '', 'label' => __('common.choose_user')]
        ];

        if($this->query) {
            $users = User::where('name', 'ilike', "%{$this->query}%")->select('id', 'name')->get();

            foreach ($users as $user) {
                $result[] = ['value' => $user->id, 'label' => $user->name];
            }

            if($users->isEmpty()) {
                $result[] = ['value' => '', 'label' => __('common.not_found'), 'disabled' => true];
            }
        }

        return $result;
    }
}

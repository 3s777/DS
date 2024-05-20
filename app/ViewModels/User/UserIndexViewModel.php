<?php

namespace App\ViewModels\User;

use Domain\Auth\Models\User;
use Spatie\ViewModels\ViewModel;

class UserIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function users()
    {
        return User::query()
            ->select('users.id', 'users.name', 'users.slug', 'users.created_at', 'users.email')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}

<?php

namespace Domain\Auth\ViewModels;

use Domain\Auth\Models\User;
use Spatie\ViewModels\ViewModel;

class AdminIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function users()
    {
        return User::query()
            ->select('users.id', 'users.name', 'users.slug', 'users.first_name', 'users.created_at', 'users.email')
            ->filtered()
            ->sorted()
            ->paginate(10)
            ->withQueryString();
    }
}

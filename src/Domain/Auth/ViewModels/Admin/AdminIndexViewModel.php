<?php

namespace Domain\Auth\ViewModels\Admin;

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
            ->filteredAdmin()
            ->sorted()
            ->paginate(50)
            ->withQueryString();
    }
}

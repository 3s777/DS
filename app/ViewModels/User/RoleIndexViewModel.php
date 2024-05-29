<?php

namespace App\ViewModels\User;


use Domain\Auth\Models\Role;
use Spatie\ViewModels\ViewModel;

class RoleIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function roles()
    {
        return Role::query()
            ->select('roles.id', 'roles.name', 'roles.display_name', 'roles.created_at')
            ->paginate(100)
            ->withQueryString();
    }
}

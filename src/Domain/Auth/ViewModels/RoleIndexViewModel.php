<?php

namespace Domain\Auth\ViewModels;

use Domain\Auth\Models\Role;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;

class RoleIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function roles()
    {
        return Cache::rememberForever('roles_all', function () {
            return Role::query()
                ->select('roles.id', 'roles.name', 'roles.display_name', 'roles.created_at')
                ->paginate(100)
                ->withQueryString();
        });
    }
}

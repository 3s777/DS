<?php

namespace App\ViewModels\User;

use Domain\Auth\Models\Permission;
use Spatie\ViewModels\ViewModel;

class PermissionIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function permissions()
    {
        return Permission::query()
            ->select('permissions.id', 'permissions.name', 'permissions.display_name', 'permissions.created_at')
            ->paginate(100)
            ->withQueryString();
    }
}

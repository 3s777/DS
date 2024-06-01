<?php

namespace App\ViewModels\User;

use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Spatie\ViewModels\ViewModel;

class RoleCreateViewModel extends ViewModel
{
    public ?Role $role;

    public function __construct(Role $role = null)
    {
        $this->role = $role;
    }

    public function permissions(): array
    {
        return Permission::all()->select('name', 'display_name')->toArray();
    }
}

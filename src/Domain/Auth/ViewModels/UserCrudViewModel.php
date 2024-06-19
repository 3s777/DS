<?php

namespace Domain\Auth\ViewModels;

use App\Models\Language;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Spatie\ViewModels\ViewModel;

class UserCrudViewModel extends ViewModel
{
    public ?User $user;

    public function __construct(User $user = null)
    {
        $this->user = $user;
    }

    public function languages(): array
    {
        return Language::all()->select('id', 'name')->toArray();
    }

    public function roles(): array
    {
        return Role::all()->select('name', 'display_name')->toArray();
    }

    public function permissions(): array
    {
        return Permission::all()->select('name', 'display_name')->toArray();
    }

    public function rolePermissions(): array
    {
        return $this->user
            ? $this->user->getPermissionsViaRoles()->pluck('name', 'display_name')->toArray()
            : [];
    }
}

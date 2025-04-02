<?php

namespace Domain\Auth\ViewModels\Admin;

use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;

class RoleUpdateViewModel extends ViewModel
{
    public ?Role $role;

    public function __construct(Role $role = null)
    {
        $this->role = $role;
    }

    public function permissionsAdmin(): array
    {
//        return Cache::rememberForever('permissions_select', function () {
            return Permission::all()->where('guard_name', 'admin')->select('name', 'display_name')->toArray();
//        });
    }

    public function permissionsCollector(): array
    {
//        return Cache::rememberForever('permissions_select', function () {
            return Permission::all()->where('guard_name', 'collector')->select('name', 'display_name')->toArray();
//        });
    }
}

<?php

namespace Domain\Auth\ViewModels;

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

    public function permissions(): array
    {
        return Cache::rememberForever('permissions_select', function () {
            return Permission::all()->select('name', 'display_name')->toArray();
        });
    }
}

<?php

namespace Domain\Auth\ViewModels;

use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Settings\Enums\LanguageEnum;
use Spatie\ViewModels\ViewModel;

class CollectorUpdateViewModel extends ViewModel
{
    public ?Collector $collector;

    public function __construct(Collector $collector = null)
    {
        $this->collector = $collector;
    }

    public function languages(): array
    {
        return LanguageEnum::cases();
    }

    public function roles(): array
    {
        return Role::where('guard_name', 'collector')->select('name', 'display_name')->pluck('display_name', 'name')->toArray();
    }

    public function selectedRoles(): ?array
    {
        return $this->collector?->roles->pluck('name')->toArray() ?? null;
    }

    public function permissions(): array
    {
        //        dd(Permission::select('name', 'display_name')->get()->toArray(),  Permission::all()->where('guard_name', 'collector')->select('name', 'display_name')->toArray());

        return Permission::all()->where('guard_name', 'collector')->select('name', 'display_name')->toArray();
    }

    public function rolePermissions(): array
    {
        return $this->collector
            ? $this->collector->getPermissionsViaRoles()->pluck('name', 'display_name')->toArray()
            : [];
    }
}

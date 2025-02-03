<?php

namespace Domain\Auth\ViewModels;

use Domain\Auth\Models\Collector;
use Domain\Auth\Models\Permission;
use Domain\Auth\Models\Role;
use Domain\Auth\Models\User;
use Domain\Setting\Enums\LanguageEnum;
use Spatie\ViewModels\ViewModel;

class CollectorUpdateViewModel extends ViewModel
{
    public ?Collector $collector;

    public function __construct(User $collector = null)
    {
        $this->collector = $collector;
    }

    public function languages(): array
    {
        return LanguageEnum::cases();
    }

    public function roles(): array
    {
        return Role::all()->select('name', 'display_name')->pluck('display_name', 'name')->toArray();
    }

    public function selectedRoles(): ?array
    {
        return $this->user?->roles->pluck('name')->toArray() ?? null;
    }

    public function permissions(): array
    {
        return Permission::all()->select('name', 'display_name')->toArray();
    }

    public function rolePermissions(): array
    {
        return $this->collector
            ? $this->collector->getPermissionsViaRoles()->pluck('name', 'display_name')->toArray()
            : [];
    }
}

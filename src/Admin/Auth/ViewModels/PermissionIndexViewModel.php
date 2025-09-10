<?php

namespace Admin\Auth\ViewModels;

use Domain\Auth\Models\Permission;
use Illuminate\Support\Facades\Cache;
use Spatie\ViewModels\ViewModel;

class PermissionIndexViewModel extends ViewModel
{
    public function __construct()
    {
        //
    }

    public function permissions()
    {
        return Cache::rememberForever('permissions_all', function () {
            return Permission::query()
                ->select(
                    'permissions.id',
                    'permissions.name',
                    'permissions.display_name',
                    'permissions.guard_name',
                    'permissions.created_at'
                )
                ->paginate(100)
                ->withQueryString();
        });
    }
}

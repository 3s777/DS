<?php

namespace Domain\Auth\Observers;

use Domain\Auth\Models\Permission;
use Illuminate\Support\Facades\Cache;

class PermissionObserver
{
    public function __construct()
    {
        Cache::forget('permissions_all');
        Cache::forget('permissions_select');
    }
    /**
     * Handle the Permission "created" event.
     */
    public function created(Permission $permission): void
    {

    }

    /**
     * Handle the Permission "updated" event.
     */
    public function updated(Permission $permission): void
    {

    }

    /**
     * Handle the Permission "deleted" event.
     */
    public function deleted(Permission $permission): void
    {

    }

    /**
     * Handle the Permission "restored" event.
     */
    public function restored(Permission $permission): void
    {

    }

    /**
     * Handle the Permission "force deleted" event.
     */
    public function forceDeleted(Permission $permission): void
    {

    }
}

<?php

namespace Domain\Game\Models\Policies;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatformManufacturer;

class GamePlatformManufacturerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('game-platform-manufacturers.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GamePlatformManufacturer $manufacturer): bool
    {
        return $user->can('game-platform-manufacturers.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('game-platform-manufacturers.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GamePlatformManufacturer $manufacturer): bool
    {
       if($user->can('game-platform-manufacturers.edit')) {
           return true;
       }

       return $user->id == $manufacturer->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GamePlatformManufacturer $manufacturer): bool
    {
        return $user->can('game-platform-manufacturers.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GamePlatformManufacturer $manufacturer): bool
    {
        return $user->can('game-platform-manufacturers.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GamePlatformManufacturer $manufacturer): bool
    {
        return $user->can('game-platform-manufacturers.delete');
    }
}

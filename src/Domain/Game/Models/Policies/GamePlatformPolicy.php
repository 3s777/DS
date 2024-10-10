<?php

namespace Domain\Game\Models\Policies;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePlatform;

class GamePlatformPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('game-platforms.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GamePlatform $platform): bool
    {
        return $user->can('game-platforms.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('game-platforms.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GamePlatform $platform): bool
    {
       if($user->can('game-platforms.edit')) {
           return true;
       }

       return $user->id == $platform->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GamePlatform $platform): bool
    {
        return $user->can('game-platforms.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GamePlatform $platform): bool
    {
        return $user->can('game-platforms.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GamePlatform $platform): bool
    {
        return $user->can('game-platforms.delete');
    }
}

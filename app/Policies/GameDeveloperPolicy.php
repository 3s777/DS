<?php

namespace App\Policies;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;
use Illuminate\Auth\Access\Response;

class GameDeveloperPolicy
{
    public function before(User $user, string $ability): bool|null
    {
        if ($user->hasRole('super_admin')) {
            return true;
        }

        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GameDeveloper $gameDeveloper): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GameDeveloper $gameDeveloper): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GameDeveloper $gameDeveloper): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GameDeveloper $gameDeveloper): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GameDeveloper $gameDeveloper): bool
    {
        //
    }
}

<?php

namespace Domain\Shelf\Models\Policies;

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Collectible;

class CollectiblePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('collectibles.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Collectible $collectible): bool
    {
        return $user->can('collectibles.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('collectibles.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Collectible $collectible): bool
    {
        if ($user->can('collectibles.edit')) {
            return true;
        }

        return $user->id == $collectible->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Collectible $collectible): bool
    {
        return $user->can('collectibles.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Collectible $collectible): bool
    {
        return $user->can('collectibles.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Collectible $collectible): bool
    {
        return $user->can('collectibles.delete');
    }
}

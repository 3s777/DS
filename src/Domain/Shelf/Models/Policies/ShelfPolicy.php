<?php

namespace Domain\Shelf\Models\Policies;

use Domain\Auth\Models\User;
use Domain\Shelf\Models\Shelf;

class ShelfPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('shelves.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Shelf $shelf): bool
    {
        return $user->can('shelves.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('shelves.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Shelf $shelf): bool
    {
       if($user->can('shelves.edit')) {
           return true;
       }

       return $user->id == $shelf->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Shelf $shelf): bool
    {
        return $user->can('shelves.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Shelf $shelf): bool
    {
        return $user->can('shelves.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Shelf $shelf): bool
    {
        return $user->can('shelves.delete');
    }
}

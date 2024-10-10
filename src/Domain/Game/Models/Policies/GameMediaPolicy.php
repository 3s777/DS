<?php

namespace Domain\Game\Models\Policies;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameMedia;

class GameMediaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('game-medias.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GameMedia $gameMedia): bool
    {
        return $user->can('game-medias.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('game-medias.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GameMedia $gameMedia): bool
    {
       if($user->can('game-medias.edit')) {
           return true;
       }

       return $user->id == $gameMedia->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GameMedia $gameMedia): bool
    {
        return $user->can('game-medias.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GameMedia $gameMedia): bool
    {
        return $user->can('game-medias.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GameMedia $gameMedia): bool
    {
        return $user->can('game-medias.delete');
    }
}

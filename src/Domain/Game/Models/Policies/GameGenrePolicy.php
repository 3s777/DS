<?php

namespace Domain\Game\Models\Policies;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameGenre;

class GameGenrePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('game-genres.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GameGenre $gameGenre): bool
    {
        return $user->can('game-genres.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('game-genres.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GameGenre $gameGenre): bool
    {
       if($user->can('game-genres.edit')) {
           return true;
       }

       return $user->id == $gameGenre->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GameGenre $gameGenre): bool
    {
        return $user->can('game-genres.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GameGenre $gameGenre): bool
    {
        return $user->can('game-genres.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GameGenre $gameGenre): bool
    {
        return $user->can('game-genres.delete');
    }
}

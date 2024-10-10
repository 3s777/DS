<?php

namespace Domain\Game\Models\Policies;

use Domain\Auth\Models\User;
use Domain\Game\Models\GameDeveloper;

class GameDeveloperPolicy
{
//    public function before(User $user, string $ability): bool|null
//    {
//        if ($user->hasRole('user')) {
//            return true;
//        }
//
//        return null;
//    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('game-developers.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GameDeveloper $gameDeveloper): bool
    {
        return $user->can('game-developers.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('game-developers.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GameDeveloper $gameDeveloper): bool
    {
       if($user->can('game-developers.edit')) {
           return true;
       }

       return $user->id == $gameDeveloper->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GameDeveloper $gameDeveloper): bool
    {
        return $user->can('game-developers.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GameDeveloper $gameDeveloper): bool
    {
        return $user->can('game-developers.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GameDeveloper $gameDeveloper): bool
    {
        return $user->can('game-developers.delete');
    }
}

<?php

namespace App\Policies;

use Domain\Auth\Models\User;
use Domain\Game\Models\GamePublisher;
use Illuminate\Auth\Access\Response;

class GamePublisherPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('game-publishers.view_all');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, GamePublisher $gamePublisher): bool
    {
        return $user->can('game-publishers.view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('game-publishers.create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, GamePublisher $gamePublisher): bool
    {
       if($user->can('game-publishers.edit')) {
           return true;
       }

       return $user->id == $gamePublisher->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, GamePublisher $gamePublisher): bool
    {
        return $user->can('game-publishers.delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, GamePublisher $gamePublisher): bool
    {
        return $user->can('game-publishers.delete');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, GamePublisher $gamePublisher): bool
    {
        return $user->can('game-publishers.delete');
    }
}

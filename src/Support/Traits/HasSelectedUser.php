<?php

namespace Support\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasSelectedUser
{
    protected function getSelectedUser(?Model $model): array
    {
        $selectedUser = [];
        if ($model?->user) {
            $selectedUser = [
                'key' => $model->user->id,
                'value' => $model->user->name,
            ];
        }

        return $selectedUser;
    }
}

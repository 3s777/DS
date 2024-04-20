<?php

namespace Support\Traits\Models;

use Illuminate\Database\Eloquent\Model;

trait HasUser
{
    protected static function bootHasUser(): void
    {
        static::creating(function (Model $item) {
            if(empty($item->user_id )) {
                $item->user_id = auth()->id();
            }
        });
    }
}

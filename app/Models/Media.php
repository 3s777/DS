<?php

namespace App\Models;

use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends BaseMedia
{
    use HasFactory;

public static function boot()
{
    parent::boot();

    static::creating(function ($model) {
        if(auth()->user()) {
            $model->user()->associate(auth()->user()) ;
        }
     });
}

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}

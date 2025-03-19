<?php

namespace App\Models;

use Carbon\Carbon;
use Domain\Auth\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends BaseMedia
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->user()) {
                $model->user()->associate(auth()->user()) ;
            }

            $modelCreatedDate = Carbon::make($model->model->created_at);
            $mediaPath = pathinfo($model->file_name);

            $model->dirname = $model->model->imagesDir().'/'
                .$modelCreatedDate->format('Y').'/'
                .$modelCreatedDate->format('m').'/'
                .$mediaPath['filename'].'/';
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}

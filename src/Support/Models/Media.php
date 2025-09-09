<?php

namespace Support\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Spatie\MediaLibrary\MediaCollections\Models\Media as BaseMedia;

class Media extends BaseMedia
{
    use HasFactory;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (auth()->check() && request()->route()->named('admin.*')) {
                $model->user()->associate(auth()->user());
            }

            if (auth()->guard('collector')->check() && !request()->route()->named('admin.*')) {
                $model->user()->associate(auth('collector')->user());
            }

            $modelCreatedDate = Carbon::make($model->model->created_at);
            $mediaPath = pathinfo($model->file_name);

            $model->dirname = $model->model->imagesDir().'/'
                .$modelCreatedDate->format('Y').'/'
                .$modelCreatedDate->format('m').'/'
                .$mediaPath['filename'].'/';
        });
    }

    public function user(): MorphTo
    {
        return $this->morphTo();
    }

}

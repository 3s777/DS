<?php

namespace App\Providers;

use App\Contracts\ImagesManager;
use Illuminate\Support\ServiceProvider;
use Intervention\Image\ImageManager;
use Support\Images\MediaLibraryImageManager;

class ImagesServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ImagesManager::class => MediaLibraryImageManager::class
    ];

    public function register()
    {
        $this->app->singleton('image', function ($app) {
            return new ImageManager(
                config('images.intervention_driver'),
            );
        });
    }
}

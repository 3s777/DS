<?php

namespace App\Providers;

use App\Contracts\ImagesManager;
use Illuminate\Support\ServiceProvider;
use Support\Images\MediaLibraryImageManager;

class ImagesServiceProvider extends ServiceProvider
{
    public array $bindings = [
        ImagesManager::class => MediaLibraryImageManager::class
    ];
}

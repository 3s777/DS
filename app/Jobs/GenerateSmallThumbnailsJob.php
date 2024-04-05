<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class GenerateSmallThumbnailsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected string $imageFullPath,
                                protected int|null $width,
                                protected int|null $height,
                                protected string $webpThumbDir)
    {
    }

    public function handle(): void
    {
        $thumbnailStorage = Storage::disk('images');
        $imagePathInfo = pathinfo($this->imageFullPath);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($thumbnailStorage->path($this->imageFullPath));

//        $thumbImage = clone $image;
//        $thumbImage
//            ->scaleDown($this->width, $this->height)
//            ->save($thumbnailStorage->path($this->originalThumbDir.'/'.$imagePathInfo['filename'].'.'.$imagePathInfo['extension']));

        $image
            ->scaleDown($this->width, $this->height)
            ->toWebp(config('thumbnail.webp_quality'))
            ->save($thumbnailStorage->path($this->webpThumbDir.'/'.$imagePathInfo['filename'].'.webp'));
    }
}

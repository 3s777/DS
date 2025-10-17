<?php

namespace App\Jobs\Support;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Support\Facades\Image;
use Support\Services\ThumbnailService;

class GenerateSmallThumbnailsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected string $imageFullPath,
        protected int|null $width,
        protected int|null $height,
        protected string $webpThumbDir
    ) {
    }

    public function handle(ThumbnailService $service): void
    {
        $service->generateSmallWebp($this->imageFullPath, $this->webpThumbDir, $this->width, $this->height);
//        $thumbnailStorage = Storage::disk('images');
//        $imagePathInfo = pathinfo($this->imageFullPath);
//
//        $image = Image::read($thumbnailStorage->path($this->imageFullPath));
//
//        //        $thumbImage = clone $image;
//        //        $thumbImage
//        //            ->scaleDown($this->width, $this->height)
//        //            ->save($thumbnailStorage->path($this->originalThumbDir.'/'.$imagePathInfo['filename'].'.'.$imagePathInfo['extension']));
//
//        $image
//            ->scaleDown($this->width)
//            ->toWebp(config('images.webp_quality'))
//            ->save($thumbnailStorage->path($this->webpThumbDir.'/'.$imagePathInfo['filename'].'.webp'));
    }
}

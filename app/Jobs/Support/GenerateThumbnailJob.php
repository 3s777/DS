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

class GenerateThumbnailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected string $imageFullPath,
        protected int|null $scaleDown = null,
        protected bool $isWebp = false,
        protected int $quality = 100,
        protected string $prefix = ''
    ) {
    }

    public function handle(ThumbnailService $service): void
    {
        $service->generateFullSize($this->imageFullPath, $this->scaleDown, $this->isWebp, $this->quality, $this->prefix);
//        $thumbnailStorage = Storage::disk('images');
//
//        $imagePathInfo = pathinfo($this->imageFullPath);
//
//        $image = Image::read($thumbnailStorage->path($this->imageFullPath));
//
//        if ($this->scaleDown) {
//            $image->scaleDown($this->scaleDown);
//        }
//
//        if ($this->isWebp) {
//            $image->toWebp($this->quality)
//                ->save($thumbnailStorage->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename']).'.webp');
//        }
//
//        if ($this->prefix) {
//            $image->save($thumbnailStorage->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'_'.$this->prefix.'.'.$imagePathInfo['extension']), $this->quality);
//        }
//
//        if (!$this->isWebp && !$this->prefix) {
//            $image->save($thumbnailStorage->path($this->imageFullPath));
//        }
    }
}

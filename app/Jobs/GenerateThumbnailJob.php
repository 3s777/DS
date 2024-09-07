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
        protected int|null $quality = null,
        protected string $prefix = ''
    ) {
    }

    public function handle(): void
    {
        $thumbnailStorage = Storage::disk('images');

        $imagePathInfo = pathinfo($this->imageFullPath);

        $manager = new ImageManager(new Driver());
        $image = $manager->read($thumbnailStorage->path($this->imageFullPath));

        if($this->scaleDown) {
            $image->scaleDown($this->scaleDown);
        }

        if($this->isWebp) {
            $image->toWebp($this->quality)
                ->save($thumbnailStorage->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename']).'.webp');
        }

        if($this->prefix) {
            $image->save($thumbnailStorage->path($imagePathInfo['dirname'].'/'.$imagePathInfo['filename'].'_'.$this->prefix.'.'.$imagePathInfo['extension']), $this->quality);
        }

        if(!$this->isWebp && !$this->prefix) {
            $image->save($thumbnailStorage->path($this->imageFullPath));
        }
    }
}

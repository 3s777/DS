<?php

namespace Support\Traits\Models;

use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    abstract protected function imagesDir(): string;

    abstract public function thumbnailSizes(): array;

    public function imageStorage(): Filesystem
    {
        return Storage::disk('images');
    }

    public function generateMediaPath(string $filename): string
    {
        $mediaCreatedDate = Carbon::make($this->created_at);
        $filePath = pathinfo($filename);

        return $this->imagesDir().'/'
            .$mediaCreatedDate->format('Y').'/'
            .$mediaCreatedDate->format('m').'/'
            .$filePath['filename'].'/';
    }

    public function generateThumbnails($imageFullPath, $specialSizes): void
    {
        $defaultThumbnails = $this->thumbnailSizes();

        $imagePathInfo = pathinfo($imageFullPath);

        if($defaultThumbnails) {

            $filteredThumbs = ($specialSizes) ? Arr::only($defaultThumbnails, $specialSizes) : $defaultThumbnails;

            $this->imageStorage()->makeDirectory($imagePathInfo['dirname'].'/webp');
            //            $this->imageStorage()->makeDirectory($imagePathInfo['dirname'].'/'.$imagePathInfo['extension']);

            foreach($filteredThumbs as $thumb) {

                $webpThumbDir = $imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1];
                //                $originalThumbDir = $imagePathInfo['dirname'].'/'.$imagePathInfo['extension'].'/'.$thumb[0].'x'.$thumb[1];

                $this->imageStorage()->makeDirectory($webpThumbDir);
                //                $this->imageStorage()->makeDirectory($originalThumbDir);

                GenerateSmallThumbnailsJob::dispatch($imageFullPath, $thumb[0], $thumb[1], $webpThumbDir);
            }
        }
    }

    public function generateFullSizes(string $imageFullPath): void
    {
        // Generate full image 2048, 100% quality
        GenerateThumbnailJob::dispatch(
            $imageFullPath,
            2048,
            false
        );

        // Generate original extension image 1200, 80% quality for webp alternative
        GenerateThumbnailJob::dispatch(
            $imageFullPath,
            1200,
            false,
            config('thumbnail.fallback_quality'),
            'fallback'
        );

        // Generate webp image 75 quality full size
        GenerateThumbnailJob::dispatch(
            $imageFullPath,
            2048,
            true,
            config('thumbnail.webp_quality')
        );
    }

    public function getThumbnailPath(): string
    {
        if(config('thumbnail.driver') == 'media_library') {
            $thumbnailMedia = $this->getFirstMedia($this->getThumbnailColumn());

            if($thumbnailMedia) {
                return $thumbnailMedia->getPathRelativeToRoot();
            }

            return '';
            //            $mediaPath = $this->generateMediaPath($thumbnailMedia->file_name);
            //            return $mediaPath.$thumbnailMedia->file_name;
            //            $mediaPath = app(MediaPathGenerator::class)->getPath($thumbnailMedia);

        } else {
            return $this->{$this->getThumbnailColumn()};
        }
    }

    public function getThumbnailPathWebp(): string
    {
        $thumbnailPathInfo = pathinfo($this->getThumbnailPath());

        if($thumbnailPathInfo['filename']) {
            return $thumbnailPathInfo['dirname'].'/'.$thumbnailPathInfo['filename'].'.webp';
        }

        return '';
    }
}

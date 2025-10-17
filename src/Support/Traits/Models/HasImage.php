<?php

namespace Support\Traits\Models;

use App\Contracts\ImagesManager;
use App\Jobs\Support\GenerateSmallThumbnailsJob;
use App\Jobs\Support\GenerateThumbnailJob;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    abstract protected function imagesDir(): string;

    abstract public function thumbnailSizes(): array;

    public function imageManager(): ImagesManager
    {
        return app()->make(ImagesManager::class, ['model' => $this]);
    }


    public function getStorageDisk(): string
    {
        return config('images.disk');
    }

    private function imagesStorage(): Filesystem
    {
        return Storage::disk($this->getStorageDisk());
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

    public function generateThumbnails(string $imageFullPath, array $specialSizes): void
    {
        $defaultThumbnails = $this->thumbnailSizes();

        $imagePathInfo = pathinfo($imageFullPath);

        if ($defaultThumbnails) {

            $filteredThumbs = ($specialSizes) ? Arr::only($defaultThumbnails, $specialSizes) : $defaultThumbnails;

            $this->imagesStorage()->makeDirectory($imagePathInfo['dirname'].'/webp');
            //            $this->imagesStorage()->makeDirectory($imagePathInfo['dirname'].'/'.$imagePathInfo['extension']);

            foreach ($filteredThumbs as $thumb) {

                $webpThumbDir = $imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1];
                //                $originalThumbDir = $imagePathInfo['dirname'].'/'.$imagePathInfo['extension'].'/'.$thumb[0].'x'.$thumb[1];

                $this->imagesStorage()->makeDirectory($webpThumbDir);
                //                $this->imagesStorage()->makeDirectory($originalThumbDir);

                GenerateSmallThumbnailsJob::dispatch($imageFullPath, $thumb[0], $thumb[1], $webpThumbDir);
            }
        }
    }

    public function generateFullSizes(string $imageFullPath): void
    {
//        // Generate full image 2048, 100% quality
//        GenerateThumbnailJob::dispatch(
//            $imageFullPath,
//            config('images.full_size'),
//            false
//        );

        // Generate original extension image 1200, 80% quality for webp alternative
        GenerateThumbnailJob::dispatch(
            $imageFullPath,
            config('images.fallback_size'),
            false,
            config('images.fallback_quality'),
            'fallback'
        );

        // Generate webp image 75 quality full size
        GenerateThumbnailJob::dispatch(
            $imageFullPath,
            config('images.full_size'),
            true,
            config('images.webp_quality')
        );
    }

    protected function addOriginal(string|UploadedFile $image, string $collectionName): string
    {
        return $this->imageManager()->add($image, $collectionName);
    }

    public function addOriginalWithThumbnail(
        string|UploadedFile|null $image,
        string $collectionName = 'default',
        array $specialSizes = []
    ): string {
        if ($image) {
            $imageFullPath = $this->addOriginal($image, $collectionName);

            $this->generateFullSizes($imageFullPath);

            $this->generateThumbnails($imageFullPath, $specialSizes);
        }

        return $imageFullPath ?? '';
    }
}

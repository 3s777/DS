<?php

namespace Support\Traits\Models;

use App\Contracts\ImagesManager;
use App\Jobs\GenerateSmallThumbnailsJob;
use App\Jobs\GenerateThumbnailJob;
use Carbon\Carbon;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

trait HasThumbnail
{
    protected static function bootHasThumbnail(): void
    {
        static::forceDeleting(function (Model $item) {
            if (config('thumbnail.driver') != 'media_library') {
                $item->deleteAllThumbnails();
            }
        });
    }

    public function getThumbnailCollection(): string
    {
        return 'thumbnail';
    }

    public function getThumbnailColumn(): string
    {
        return 'thumbnail';
    }

    public function imageManager(): ImagesManager
    {
        return app()->make(ImagesManager::class, ['model' => $this]);
    }

    protected function addOriginalImage(UploadedFile $image, string $collectionName, string $type): string
    {
        return $this->imageManager()->addOriginal($image, $collectionName, $type);
    }

    public function addImageWithThumbnail(
        UploadedFile|null $image,
        string $collectionName = 'default',
        array $specialSizes = [],
        string $type = 'thumbnail',
    ): void {
        if($image) {
            $imageFullPath = $this->addOriginalImage($image, $collectionName, $type);

            $this->generateFullSizes($imageFullPath);

            $this->generateThumbnails($imageFullPath, $specialSizes);
        }
    }

    public function deleteAllThumbnails(): void
    {
        $this->imageManager()->deleteAllThumbnails();
    }

    public function updateThumbnail($newThumbnail, $oldThumbnail = '', $sizes = [])
    {
        if(!$oldThumbnail && !$newThumbnail) {
            $this->deleteAllThumbnails();
        }

        if($newThumbnail) {
            $this->deleteAllThumbnails();

            $this->addImageWithThumbnail(
                $newThumbnail,
                $this->getThumbnailColumn(),
                $sizes
            );
        }
    }
}

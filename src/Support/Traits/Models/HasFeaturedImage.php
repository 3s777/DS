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

trait HasFeaturedImage
{
    protected static function bootHasFeaturedImage(): void
    {
        static::forceDeleting(function (Model $item) {
            if (config('images.driver') != 'media_library') {
                $item->deleteAllThumbnails();
            }
        });
    }

    public function getFeaturedImageCollection(): string
    {
        return 'featured';
    }

    public function getFeaturedImageColumn(): string
    {
        return 'featured_image';
    }

    public function imageManager(): ImagesManager
    {
        return app()->make(ImagesManager::class, ['model' => $this]);
    }

    protected function addOriginalImage(UploadedFile $image, string $collectionName, string $type): string
    {
        $imagePath = $this->imageManager()->addOriginal($image, $collectionName, $type);
        $this->save();
        return $imagePath;
    }

    public function addImageWithThumbnail(
        UploadedFile|null $image,
        string $collectionName = 'default',
        array $specialSizes = [],
        string $type = 'featured_image',
    ): void {
        if($image) {
            $imageFullPath = $this->addOriginalImage($image, $collectionName, $type);

            $this->generateFullSizes($imageFullPath);

            $this->generateThumbnails($imageFullPath, $specialSizes);
        }
    }

    public function deleteFeaturedImage(): void
    {
        $this->imageManager()->deleteAllThumbnails();
    }

    public function updateFeaturedImage($newFeaturedImage, $oldFeaturedImage = '', $sizes = [])
    {
        if(!$oldFeaturedImage && !$newFeaturedImage) {
            $this->deleteFeaturedImage();
        }

        if($newFeaturedImage) {
            $this->deleteFeaturedImage();

            $this->addImageWithThumbnail(
                $newFeaturedImage,
                $this->getFeaturedImageColumn(),
                $sizes
            );
        }
    }
}

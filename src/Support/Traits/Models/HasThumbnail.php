<?php

namespace Support\Traits\Models;

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

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    protected function addOriginalWithMediaLibrary(UploadedFile $image, $collectionName): string
    {
        $media = $this->addMedia($image)
            ->toMediaCollection($collectionName, 'images');
        //        $mediaPath = app(MediaPathGenerator::class)->getPath($media);
        //        $this->{$this->getThumbnailColumn()} = $mediaPath.$media->file_name;
        $this->{$this->getThumbnailColumn()} = $media->getPathRelativeToRoot();
        $this->save();

        return $media->getPathRelativeToRoot();
    }

    protected function addOriginal(UploadedFile $image): string
    {
        // TODO upload image without MediaLibrary
        //        $imageDir = $this->generateMediaPath($imageFileName);
        return $image;
    }

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function addImageWithThumbnail(
        UploadedFile|null $image,
        string $collectionName = 'default',
        array $specialSizes = []
    ): void {
        if($image) {
            if(config('thumbnail.driver') == 'media_library') {
                $imageFullPath = $this->addOriginalWithMediaLibrary($image, $collectionName);
            } else {
                $imageFullPath = $this->addOriginal($image);
            }

            $this->generateFullSizes($imageFullPath);

            $this->generateThumbnails($imageFullPath, $specialSizes);
        }
    }

    public function deleteAllThumbnails(): void
    {
        if(config('thumbnail.driver') == 'media_library') {
            $media = $this->getFirstMedia($this->getThumbnailColumn());
            $media?->forceDelete();
            return;
        }

        if($this->{$this->getThumbnailColumn()}) {
            $imagePathInfo = pathinfo($this->{$this->getThumbnailColumn()});
            $this->imageStorage()->delete($imagePathInfo['dirname']);
        }
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

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
    abstract protected function thumbnailDir(): string;

    abstract public function thumbnailSizes(): array;

    public function getThumbnailColumn(): string
    {
        return 'thumbnail';
    }

    public function thumbnailStorage(): Filesystem
    {
        return Storage::disk('images');
    }

    public function generateMediaPath(string $filename): string
    {
        $mediaCreatedDate = Carbon::make($this->created_at);
        $filePath = pathinfo($filename);

        return $this->thumbnailDir().'/'
            .$mediaCreatedDate->format('Y').'/'
            .$mediaCreatedDate->format('m').'/'
            .$filePath['filename'].'/';
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

    public function generateThumbnails($imageFullPath, $specialSizes): void
    {
        $defaultThumbnails = $this->thumbnailSizes();

        $imagePathInfo = pathinfo($imageFullPath);

        if($defaultThumbnails) {

            $filteredThumbs = ($specialSizes) ? Arr::only($defaultThumbnails, $specialSizes) : $defaultThumbnails;

            $this->thumbnailStorage()->makeDirectory($imagePathInfo['dirname'].'/webp');
//            $this->thumbnailStorage()->makeDirectory($imagePathInfo['dirname'].'/'.$imagePathInfo['extension']);

            foreach($filteredThumbs as $thumb) {

                $webpThumbDir = $imagePathInfo['dirname'].'/webp/'.$thumb[0].'x'.$thumb[1];
//                $originalThumbDir = $imagePathInfo['dirname'].'/'.$imagePathInfo['extension'].'/'.$thumb[0].'x'.$thumb[1];

                $this->thumbnailStorage()->makeDirectory($webpThumbDir);
//                $this->thumbnailStorage()->makeDirectory($originalThumbDir);

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

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function addImageWithThumbnail(UploadedFile|null $image,
                                          string $collectionName = 'default',
                                          array $specialSizes = []): void
    {
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

    public function deleteAllThumbnails(): void
    {
        if(config('thumbnail.driver') == 'media_library') {
            $media = $this->getFirstMedia($this->getThumbnailColumn());
            $media?->forceDelete();
            return;
        }

        if($this->{$this->getThumbnailColumn()}) {
            $imagePathInfo = pathinfo($this->{$this->getThumbnailColumn()});
            $this->thumbnailStorage()->delete($imagePathInfo['dirname']);
        }
    }

    public function updateThumbnail($newThumbnail, $oldThumbnail ='', $sizes = [])
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

<?php

namespace Support\Images;

use App\Contracts\ImagesManager;
use App\Models\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MediaLibraryImageManager implements ImagesManager
{
    public function __construct(public Model $model)
    {
    }

    public function add(string|UploadedFile $image, ?string $collectionName): string
    {
        if (is_string($image)) {
            $media = $this->model->addMedia($image)
                ->preservingOriginal()
                ->toMediaCollection($collectionName, $this->model->getStorageDisk());
        } else {
            $media = $this->model->addMedia($image)
                ->toMediaCollection($collectionName, $this->model->getStorageDisk());
        }

        //        $mediaPath = app(MediaPathGenerator::class)->getPath($media);
        //        $this->{$this->getThumbnailColumn()} = $mediaPath.$media->file_name;

        return $media->getPathRelativeToRoot();
    }

    public function deleteByPath(string $path): void
    {
        // After deleting Media relation don't change.
        // Media library use method loadMedia
        // New Media relation can be available in new model object
        $media = $this->model->media->where('file_name', basename($path))->first();
        // this method don't described in Media Library documentation
        // $this->model->deleteMedia($media->id);
        $media?->forceDelete();
    }

    public function deleteFeaturedImage(): void
    {
        $medias = $this->model->getMedia($this->model->getFeaturedImageCollection());

        if ($medias) {
            foreach ($medias as $media) {
                $media?->forceDelete();
            }
        }
    }

    public function getFeaturedImagePath(): string
    {
        $featuredImageMedia = $this->model->getFirstMedia($this->model->getFeaturedImageCollection());

        if ($featuredImageMedia) {
            return $featuredImageMedia->getPathRelativeToRoot();
        }

        return '';

        //            $mediaPath = $this->generateMediaPath($thumbnailMedia->file_name);
        //            return $mediaPath.$thumbnailMedia->file_name;
        //            $mediaPath = app(MediaPathGenerator::class)->getPath($thumbnailMedia);
    }

    public function getImagesPath(): array
    {
        $images = $this->model->getMedia($this->model->getImagesCollection());
        $imagesArr = [];

        if ($images) {
            foreach ($images as $image) {
                $imagesArr[] = $image->getPathRelativeToRoot();
            }
        }

        return $imagesArr;
    }
}

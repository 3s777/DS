<?php

namespace Support\Images;

use App\Contracts\ImagesManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class MediaLibraryImageManager implements ImagesManager
{
    public function __construct(public Model $model)
    {
    }

    public function add(UploadedFile $image, ?string $collectionName): string
    {
        $media = $this->model->addMedia($image)
            ->toMediaCollection($collectionName, $this->model->getStorageDisk());
        //        $mediaPath = app(MediaPathGenerator::class)->getPath($media);
        //        $this->{$this->getThumbnailColumn()} = $mediaPath.$media->file_name;

        return $media->getPathRelativeToRoot();
    }

    public function deleteByPath(string $path): void
    {
        $media = $this->model->media->where('file_name', basename($path))->first();
        $media?->forceDelete();
    }

    public function deleteFeaturedImage(): void
    {
        $medias = $this->model->getMedia($this->model->getFeaturedImageCollection());

        if($medias) {
            foreach ($medias as $media) {
                $media?->forceDelete();
            }
        }
    }

    public function getFeaturedImagePath(): string
    {
        $featuredImageMedia = $this->model->getFirstMedia($this->model->getFeaturedImageCollection());

        if($featuredImageMedia) {
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

        if($images) {
            foreach($images as $image) {
                $imagesArr[] = $image->getPathRelativeToRoot();
            }
        }

        return $imagesArr;
    }
}

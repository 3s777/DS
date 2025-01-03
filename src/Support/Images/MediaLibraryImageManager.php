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

    public function addOriginal(UploadedFile $image, ?string $collectionName, ?string $type): string
    {
        $media = $this->model->addMedia($image)
            ->toMediaCollection($collectionName, 'images');
        //        $mediaPath = app(MediaPathGenerator::class)->getPath($media);
        //        $this->{$this->getThumbnailColumn()} = $mediaPath.$media->file_name;

        if(method_exists($this->model, 'getFeaturedImageColumn') && $type === $this->model->getFeaturedImageColumn()) {
                $this->model->{$this->model->getFeaturedImageColumn()} = $media->getPathRelativeToRoot();
        }

        if(method_exists($this->model, 'getImagesColumn') && $type === $this->model->getImagesColumn()) {
            $images = $this->model->{$this->model->getImagesColumn()};

            if (!$images) {
                $images = [];
            }

            $images[] = $media->getPathRelativeToRoot();

            $this->model->{$this->model->getImagesColumn()} = $images;
        }

        return $media->getPathRelativeToRoot();
    }

    public function deleteAllThumbnails(): void
    {
        $media = $this->model->getFirstMedia($this->model->getFeaturedImageColumn());
        $media?->forceDelete();
    }

    public function getThumbnailPath(): string
    {
        // TODO: Implement getThumbnailPath() method.
    }

    public function getImagesPath(): array
    {
        // TODO: Implement getImagesPath() method.
    }
}
